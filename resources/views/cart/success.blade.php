@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <!-- Success Message -->
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
                        <i class="fas fa-check text-3xl text-green-500"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Thank You for Your Order!</h1>
                    <p class="text-lg text-gray-600 mb-6">Your order has been placed successfully.</p>
                    <div class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-800">
                        Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
                    </div>
                </div>

                <!-- Order Details -->
                <div class="border-t border-gray-200">
                    <div class="p-6 space-y-6">
                        <!-- Shipping Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Information</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Full Name</p>
                                        <p class="font-medium">{{ $order->customer->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-medium">{{ $order->customer->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Phone</p>
                                        <p class="font-medium">{{ $order->customer->phone }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Payment Method</p>
                                        <p class="font-medium">{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-500">Shipping Address</p>
                                    <p class="font-medium">{{ $order->shipping_address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Items</h3>
                            <div class="bg-gray-50 rounded-lg divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                    <div class="p-4 flex items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $item->product->image_url }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-16 h-16 object-cover rounded-lg">
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium text-gray-900">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Subtotal</span>
                                        <span class="font-medium">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Shipping</span>
                                        <span class="font-medium">Free</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Tax</span>
                                        <span class="font-medium">Rp 0</span>
                                    </div>
                                    <div class="pt-2 mt-2 border-t border-gray-200">
                                        <div class="flex justify-between">
                                            <span class="text-base font-semibold text-gray-900">Total</span>
                                            <span class="text-xl font-bold text-gray-900">
                                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($order->notes)
                            <!-- Order Notes -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Notes</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-700">{{ $order->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="border-t border-gray-200 p-6">
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('orders.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-gray-900 hover:bg-gray-800 transition-colors">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            View My Orders
                        </a>
                        <a href="{{ route('shop') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-base font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <i class="fas fa-store mr-2"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection