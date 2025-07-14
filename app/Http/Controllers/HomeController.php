<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get best selling products with caching
        $products = Cache::remember('home_best_selling_products', 3600, function () {
            return Product::with('category')
                ->select('products.*')
                ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                ->where('products.is_active', true)
                ->groupBy('products.id')
                ->orderByRaw('COUNT(order_items.id) DESC')
                ->take(8)
                ->get();
        });

        // If user is admin, get additional stats with caching
        if (Auth::check() && Auth::user()->role === 'admin') {
            $stats = Cache::remember('admin_dashboard_stats', 1800, function () {
                return [
                    'total_products' => Product::count(),
                    'total_orders' => Order::count(),
                    'total_customers' => User::where('role', 'customer')->count(),
                    'total_revenue' => Order::where('status', 'completed')
                                          ->sum('total_amount'),
                    'recent_orders' => Order::where('created_at', '>=', now()->subDays(7))
                                          ->count(),
                    'stock_alerts' => Product::where('stock', '<=', 5)->count()
                ];
            });

            return view('home', compact('products', 'stats'));
        }

        // For regular users and guests
        $stats = [
            'total_products' => Cache::remember('total_active_products', 3600, function () {
                return Product::where('is_active', true)->count();
            }),
            'total_customers' => Cache::remember('total_customers', 3600, function () {
                return User::where('role', 'customer')->count();
            })
        ];

        return view('home', compact('products', 'stats'));
    }
}
