<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Shopping Cart</h1>
                <a href="{{ route('shop') }}" class="text-gray-600 hover:text-gray-900 flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Continue Shopping</span>
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm flex items-center gap-2 text-green-800 border border-green-200">
                    <i class="fas fa-check-circle text-green-400"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-50 p-4 text-sm flex items-center gap-2 text-red-800 border border-red-200">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(empty($cart))
                <div class="bg-white rounded-2xl shadow-sm p-16">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                            <i class="fas fa-shopping-cart text-3xl text-gray-400"></i>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-2">Your cart is empty</h2>
                        <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
                        <a href="{{ route('shop') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-gray-900 hover:bg-gray-800 transition-colors">
                            Start Shopping
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                            <div class="divide-y divide-gray-200">
                                @foreach($cart as $id => $item)
                                    <div class="p-6">
                                        <div class="flex items-center gap-6">
                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                <img src="{{ $item['image'] }}" 
                                                     alt="{{ $item['name'] }}" 
                                                     class="w-24 h-24 object-cover rounded-lg">
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $item['name'] }}</h3>
                                                <p class="text-gray-500 text-sm mb-4">Unit Price: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                                
                                                <div class="flex items-center gap-4">
                                                    <!-- Quantity Input -->
                                                    <div class="flex items-center" 
                                                         x-data="cartItem{{ $id }}">
                                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                                            <button type="button" 
                                                                    @click="decrementQuantity"
                                                                    class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-l-lg">
                                                                <i class="fas fa-minus text-xs"></i>
                                                            </button>
                                                            <div class="w-14 h-10 flex items-center justify-center border-l border-r border-gray-300">
                                                                <span x-text="quantity" class="text-gray-900 font-medium"></span>
                                                            </div>
                                                            <button type="button"
                                                                    @click="incrementQuantity"
                                                                    class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-r-lg">
                                                                <i class="fas fa-plus text-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Remove Button -->
                                                    <form action="{{ route('cart.remove', $id) }}" 
                                                          method="POST" 
                                                          class="flex-shrink-0"
                                                          onsubmit="return confirm('Are you sure you want to remove this item?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-sm text-gray-400 hover:text-red-600 flex items-center gap-1">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Remove</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Price -->
                                            <div class="flex-shrink-0 text-right">
                                                <p class="text-lg font-semibold text-gray-900" id="total-{{ $id }}">
                                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Shipping</span>
                                    <span>Calculated at checkout</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Tax</span>
                                    <span>Calculated at checkout</span>
                                </div>
                                
                                <div class="border-t border-gray-200 mt-4 pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-base font-semibold text-gray-900">Total</span>
                                        <span class="text-xl font-bold text-gray-900" id="cart-total">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('cart.checkout') }}" 
                                   class="w-full flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-gray-900 hover:bg-gray-800 transition-colors gap-2">
                                    <span>Proceed to Checkout</span>
                                    <i class="fas fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        @foreach($cart as $id => $item)
        document.addEventListener('alpine:init', () => {
            Alpine.data('cartItem{{ $id }}', () => ({
                quantity: {{ $item['quantity'] }},
                originalQuantity: {{ $item['quantity'] }},
                productId: {{ $id }},
                timeout: null,

                incrementQuantity() {
                    this.quantity++;
                    this.updateQuantity();
                },

                decrementQuantity() {
                    if (this.quantity > 1) {
                        this.quantity--;
                        this.updateQuantity();
                    }
                },

                updateQuantity() {
                    if (this.quantity === this.originalQuantity) return;
                    
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => {
                        const token = document.querySelector('meta[name="csrf-token"]').content;
                        fetch(`{{ route('cart.update', '') }}/${this.productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'X-HTTP-Method-Override': 'PUT'
                            },
                            body: JSON.stringify({ quantity: this.quantity })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                this.originalQuantity = this.quantity;
                                document.getElementById(`total-${this.productId}`).textContent = 
                                    'Rp ' + new Intl.NumberFormat('id-ID').format(data.itemTotal);
                                document.getElementById('cart-total').textContent = 
                                    'Rp ' + new Intl.NumberFormat('id-ID').format(data.cartTotal);
                            } else {
                                this.quantity = this.originalQuantity;
                                alert(data.message || 'Failed to update quantity');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.quantity = this.originalQuantity;
                            alert('Failed to update quantity. Please try again.');
                        });
                    }, 500);
                }
            }))
        })
        @endforeach
    </script>
    @endpush
</x-app-layout>