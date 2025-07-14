<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrder;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cart', 'total'));
    }
    
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session('cart', []);
        
        $quantity = $request->input('quantity', 1);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_url,
                'quantity' => $quantity
            ];
        }
        
        session(['cart' => $cart]);
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    public function updateCart(Request $request, $productId)
    {
        $cart = session('cart', []);
        
        if (!isset($cart[$productId])) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ], 404);
        }

        $quantity = max(1, $request->quantity);
        
        // Update the quantity
        $cart[$productId]['quantity'] = $quantity;
        session(['cart' => $cart]);
        
        // Calculate new totals
        $itemTotal = $cart[$productId]['price'] * $quantity;
        $cartTotal = 0;
        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal
        ]);
    }
    
    public function removeFromCart($productId)
    {
        $cart = session('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
        
        session(['cart' => $cart]);
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
    
    public function checkout()
    {
        \Log::info('Checkout method called');
        
        if (!Auth::check()) {
            \Log::info('User not authenticated');
            return redirect()->route('login')
                           ->with('error', 'Silahkan login terlebih dahulu untuk melanjutkan checkout.');
        }

        \Log::info('User authenticated: ' . Auth::id());
        
        $cart = session('cart', []);
        \Log::info('Cart contents: ' . json_encode($cart));
        
        if (empty($cart)) {
            \Log::info('Cart is empty');
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong!');
        }

        // Validasi stok sebelum checkout
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                // Jika produk tidak ditemukan atau stok tidak cukup
                if (!$product) {
                    unset($cart[$id]);
                    session(['cart' => $cart]);
                    return redirect()->route('cart.index')
                        ->with('error', 'Beberapa produk tidak tersedia lagi. Silahkan periksa keranjang Anda.');
                }
                
                return redirect()->route('cart.index')
                    ->with('error', "Stok {$product->name} tidak mencukupi. Tersedia: {$product->stock}, Diminta: {$item['quantity']}");
            }
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        \Log::info('Proceeding to checkout page with total: ' . $total);
        return view('cart.checkout', compact('cart', 'total'));
    }
    
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|in:bank_transfer,cod,ewallet',
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor telepon harus diisi',
            'address.required' => 'Alamat pengiriman harus diisi',
            'payment_method.required' => 'Metode pembayaran harus dipilih',
        ]);
        
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong!');
        }
        
        DB::beginTransaction();
        
        try {
            // Validasi stok sekali lagi sebelum membuat order
            $unavailableProducts = [];
            foreach ($cart as $id => $item) {
                $product = Product::find($id);
                if (!$product || $product->stock < $item['quantity']) {
                    if (!$product) {
                        $unavailableProducts[] = "Produk tidak tersedia";
                    } else {
                        $unavailableProducts[] = "{$product->name} (Stok tersedia: {$product->stock}, Diminta: {$item['quantity']})";
                    }
                }
            }

            if (!empty($unavailableProducts)) {
                DB::rollback();
                return redirect()->route('cart.index')
                    ->with('error', "Beberapa produk tidak tersedia:\n" . implode("\n", $unavailableProducts));
            }

            // Create or update customer
            $customer = Customer::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]
            );
            
            // Calculate total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            
            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->address,
                'notes' => $request->notes,
                'order_date' => now(),
            ]);
            
            // Create order items and update stock
            foreach ($cart as $id => $item) {
                $product = Product::find($id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                
                // Update product stock
                $product->decrement('stock', $item['quantity']);
            }
            
            DB::commit();
            // Ambil ulang order dari database agar total_amount pasti terisi
            $order = Order::find($order->id);
            // Kirim notifikasi ke semua admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewOrder($order));
            }
            
            // Clear cart
            session()->forget('cart');
            
            return redirect()->route('order.success', $order->id)
                           ->with('success', 'Pesanan berhasil dibuat!');
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error processing checkout: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }
    
    public function orderSuccess($orderId)
    {
        \Log::info('Order success page accessed for order ID: ' . $orderId);
        
        try {
            $order = Order::with(['customer', 'orderItems.product'])
                         ->where('user_id', Auth::id())
                         ->findOrFail($orderId);
            
            \Log::info('Order found:', [
                'order_id' => $order->id,
                'customer_id' => $order->customer_id,
                'total_amount' => $order->total_amount,
                'items_count' => $order->orderItems->count()
            ]);
            
            return view('cart.success', compact('order'));
            
        } catch (\Exception $e) {
            \Log::error('Error in order success page:', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('orders.index')
                           ->with('error', 'Order not found or you do not have permission to view it.');
        }
    }
    

    public function myOrders(Request $request)
    {
        $query = Auth::user()->orders()->with(['orderItems.product', 'customer']);
        
        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        // PASTIKAN menggunakan paginate(), BUKAN get()
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    // Tambahkan method-method ini juga di CartController jika Anda tidak membuat OrderController terpisah:

    public function showOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $order->load(['orderItems.product', 'customer']);
        return view('orders.show', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            abort(403);
        }
        
        $order->update(['status' => 'cancelled']);
        
        return redirect()->route('orders.index')
            ->with('success', 'Order cancelled successfully.');
    }

    public function downloadInvoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Generate PDF invoice logic here
        return response()->json(['message' => 'Invoice download feature coming soon']);
    }

    public function trackOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('orders.track', compact('order'));
    }
}