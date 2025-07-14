<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'products'])
                     ->orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search berdasarkan ID order atau nama user
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(10);

        // Statistik order
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        return view('dashboard.transactions.index', compact('orders', 'stats'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'products']);
        return view('dashboard.transactions.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,refunded'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // Mark related notifications as read for all admin if status bukan pending
        if ($request->status !== 'pending') {
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $notif = $admin->unreadNotifications()
                    ->where('data->order_id', $order->id)
                    ->first();
                if ($notif) {
                    $notif->markAsRead();
                }
            }
        }

        return redirect()->back()->with('success', 'Status order berhasil diupdate!');
    }

    public function destroy(Order $order)
    {
        // Hanya bisa hapus order yang masih pending atau cancelled
        if (!in_array($order->status, ['pending', 'cancelled'])) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus order dengan status ' . $order->status);
        }

        $order->delete();

        return redirect()->route('dashboard.transactions.index')
                         ->with('success', 'Order berhasil dihapus!');
    }

    public function print(Order $order)
    {
        $order->load(['user', 'products']);
        return view('dashboard.transactions.print', compact('order'));
    }
}
