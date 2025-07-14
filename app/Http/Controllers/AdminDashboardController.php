<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        // Get recent orders with user information
        $recent_orders = Order::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Get top selling products
        $top_products = Product::withCount(['orders' => function($query) {
                                $query->where('status', 'completed');
                            }])
                            ->orderBy('orders_count', 'desc')
                            ->take(5)
                            ->get();

        // Get customer growth stats
        $customer_stats = [
            'new_customers' => User::where('role', 'customer')
                                ->where('created_at', '>=', now()->subDays(30))
                                ->count(),
            'verified_customers' => User::where('role', 'customer')
                                    ->whereNotNull('email_verified_at')
                                    ->count(),
        ];

        // Get order status distribution
        $order_stats = [
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
        ];

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'stats' => $stats,
            'recent_orders' => $recent_orders,
            'top_products' => $top_products,
            'customer_stats' => $customer_stats,
            'order_stats' => $order_stats
        ]);
    }
} 