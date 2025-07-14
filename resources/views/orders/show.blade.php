@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-900 transition-colors">
                <i class="fas fa-chevron-left mr-2 text-sm"></i>
                <span class="text-sm font-medium">Back to Orders</span>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Order Header -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <h1 class="text-xl font-bold text-gray-900">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
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
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                        <p class="text-sm text-gray-500">{{ $order->orderItems->sum('quantity') }} item(s)</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-8">
                <!-- Order Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-sm font-medium text-gray-900 mb-4">Shipping Information</h2>
                        <div class="space-y-2 text-sm">
                            <p class="font-medium text-gray-900">{{ $order->customer->name }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address }}</p>
                            <p class="text-gray-600">{{ $order->customer->phone }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-sm font-medium text-gray-900 mb-4">Payment Information</h2>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method:</span>
                                <span class="font-medium text-gray-900">Bank Transfer</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="font-medium text-green-600">Paid</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Transaction ID:</span>
                                <span class="font-medium text-gray-900">TRX{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div>
                    <h2 class="text-sm font-medium text-gray-900 mb-4">Order Items</h2>
                    <div class="border border-gray-200 rounded-lg divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                            <div class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $item->product->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</span> × {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <div class="font-medium text-gray-900">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($order->status == 'pending')
                    <div class="flex justify-end">
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                <i class="fas fa-times mr-2"></i>
                                Cancel Order
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 