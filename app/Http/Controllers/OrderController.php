<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; // Jika menggunakan barryvdh/laravel-dompdf

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index(Request $request)
    {
        \Log::info('Accessing orders index page', [
            'user_id' => Auth::id(),
            'request' => $request->all()
        ]);

        $query = Order::where('user_id', Auth::id())
                      ->with(['orderItems.product', 'customer']);
        
        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        // Search by order ID or product name
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhereHas('orderItems.product', function($productQuery) use ($search) {
                      $productQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $orders = $query->latest()->paginate(10);
        
        \Log::info('Orders retrieved', [
            'count' => $orders->count(),
            'total' => $orders->total()
        ]);
        
        // Append query parameters to pagination links
        $orders->appends($request->query());
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        $order->load(['orderItems.product', 'customer']);
        return view('orders.show', compact('order'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel(Order $order)
    {
        // Check authorization and order status
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')
                ->with('error', 'Only pending orders can be cancelled.');
        }
        
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('orders.index')
            ->with('success', 'Order #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' has been cancelled successfully.');
    }

    /**
     * Download invoice for the specified order.
     */
    public function invoice(Order $order)
    {
        // Check authorization and order status
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        if (!in_array($order->status, ['delivered', 'completed'])) {
            return redirect()->route('orders.index')
                ->with('error', 'Invoice is only available for delivered orders.');
        }
        
        $order->load(['orderItems.product', 'customer']);
        
        // Generate PDF using DomPDF (install: composer require barryvdh/laravel-dompdf)
        try {
            $pdf = PDF::loadView('orders.invoice', compact('order'));
            $filename = 'invoice-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . '.pdf';
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->route('orders.index')
                ->with('error', 'Unable to generate invoice. Please try again later.');
        }
    }

    /**
     * Track the specified order.
     */
    public function track(Order $order)
    {
        // Check authorization
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        if (!in_array($order->status, ['shipped', 'delivered'])) {
            return redirect()->route('orders.index')
                ->with('error', 'Tracking is only available for shipped orders.');
        }
        
        $order->load(['orderItems.product']);
        
        // Simulate tracking data (replace with real tracking API)
        $trackingData = [
            'tracking_number' => $order->tracking_number ?? 'TRK' . str_pad($order->id, 8, '0', STR_PAD_LEFT),
            'status' => $order->status,
            'estimated_delivery' => $order->estimated_delivery ?? now()->addDays(3),
            'tracking_history' => [
                [
                    'status' => 'Order Confirmed',
                    'date' => $order->created_at,
                    'location' => 'Warehouse'
                ],
                [
                    'status' => 'Package Shipped',
                    'date' => $order->updated_at,
                    'location' => 'Distribution Center'
                ]
            ]
        ];
        
        return view('orders.track', compact('order', 'trackingData'));
    }

    /**
     * Reorder items from the specified order.
     */
    public function reorder(Order $order)
    {
        // Check authorization
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        $addedItems = 0;
        
        foreach ($order->orderItems as $item) {
            if ($item->product && $item->product->stock >= $item->quantity) {
                // Add to cart logic (adjust based on your cart implementation)
                // CartService::add($item->product_id, $item->quantity);
                $addedItems++;
            }
        }
        
        if ($addedItems > 0) {
            return redirect()->route('cart.index')
                ->with('success', "{$addedItems} items have been added to your cart.");
        } else {
            return redirect()->route('orders.index')
                ->with('error', 'No items could be added to cart. Some products may be out of stock.');
        }
    }

    /**
     * Show review form for delivered order.
     */
    public function reviewForm(Order $order)
    {
        // Check authorization and order status
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        if ($order->status !== 'delivered') {
            return redirect()->route('orders.index')
                ->with('error', 'Reviews can only be submitted for delivered orders.');
        }
        
        $order->load(['orderItems.product']);
        return view('orders.review', compact('order'));
    }

    /**
     * Submit review for the specified order.
     */
    public function submitReview(Request $request, Order $order)
    {
        // Check authorization
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to order.');
        }
        
        $request->validate([
            'reviews' => 'required|array',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'reviews.*.review' => 'nullable|string|max:1000',
        ]);
        
        foreach ($request->reviews as $productId => $reviewData) {
            // Save review to database (adjust based on your review model)
            // Review::updateOrCreate([
            //     'user_id' => Auth::id(),
            //     'product_id' => $productId,
            //     'order_id' => $order->id,
            // ], [
            //     'rating' => $reviewData['rating'],
            //     'review' => $reviewData['review'] ?? null,
            // ]);
        }
        
        return redirect()->route('orders.index')
            ->with('success', 'Thank you for your review!');
    }
}