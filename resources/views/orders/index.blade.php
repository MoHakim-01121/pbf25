@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">My Orders</h1>
                <p class="text-sm text-gray-500 mt-1">Track and manage your orders</p>
            </div>

            @if($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:border-gray-300 transition-colors">
                            <div class="p-5">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div>
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h3 class="text-base font-bold text-gray-900">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                                            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full 
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                                @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                                @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <p class="text-sm text-gray-500">{{ $order->orderItems->sum('quantity') }} item(s)</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <a href="{{ route('orders.show', $order->id) }}" 
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors">
                                        <span>View Details</span>
                                        <i class="fas fa-chevron-right ml-2 text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12">
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="fas fa-shopping-bag text-5xl text-gray-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No orders yet</h3>
                        <p class="text-sm text-gray-500 mb-6">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                        <a href="{{ route('shop') }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection