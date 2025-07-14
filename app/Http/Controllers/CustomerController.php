<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', 'customer')
            ->withCount(['orders', 'completedOrders'])
            ->withSum('orders as total_spending', 'total_amount')
            ->with('latestOrder');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Transaction status filter
        if ($request->filled('transaction_status')) {
            if ($request->transaction_status === 'has_transaction') {
                $query->has('orders');
            } elseif ($request->transaction_status === 'no_transaction') {
                $query->doesntHave('orders');
            }
        }

        // Join period filter
        if ($request->filled('join_period')) {
            switch ($request->join_period) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->where('created_at', '>=', now()->subDays(7));
                    break;
                case 'month':
                    $query->where('created_at', '>=', now()->subDays(30));
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        // Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'most_transactions':
                $query->orderByDesc('orders_count');
                break;
            case 'highest_spending':
                $query->orderByDesc('total_spending');
                break;
            default:
                $query->latest();
                break;
        }

        $customers = $query->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'totalCustomers' => User::where('role', 'customer')->count(),
            'newCustomers' => User::where('role', 'customer')
                                ->where('created_at', '>=', now()->subDays(30))
                                ->count(),
            'totalTransactions' => DB::table('orders')
                                   ->join('users', 'orders.user_id', '=', 'users.id')
                                   ->where('users.role', 'customer')
                                   ->count(),
            'totalRevenue' => DB::table('orders')
                               ->join('users', 'orders.user_id', '=', 'users.id')
                               ->where('users.role', 'customer')
                               ->where('orders.status', 'completed')
                               ->sum('total_amount')
        ];

        return view('dashboard.customers.index', [
            'customers' => $customers,
            'totalCustomers' => $stats['totalCustomers'],
            'newCustomers' => $stats['newCustomers'],
            'totalTransactions' => $stats['totalTransactions'],
            'totalRevenue' => $stats['totalRevenue']
        ]);
    }

    public function show(User $customer)
    {
        $customer->load([
            'orders' => function ($query) {
                $query->latest();
            },
            'orders.orderItems.product'
        ]);

        return view('dashboard.customers.show', compact('customer'));
    }
}
