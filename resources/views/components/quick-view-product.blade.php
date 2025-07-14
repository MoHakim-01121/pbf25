<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Product Image -->
    <div class="relative">
        <div class="aspect-square bg-gray-50 rounded-xl p-8">
            <img src="{{ $product->image_url }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-contain">
        </div>
        @if($product->discount > 0)
            <div class="absolute top-4 left-4">
                <span class="bg-rose-500 text-white px-2 py-1 rounded text-sm font-medium">
                    -{{ $product->discount }}%
                </span>
            </div>
        @endif
    </div>

    <!-- Product Details -->
    <div>
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-1">{{ $product->category->name }}</p>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $product->name }}</h2>
            
            <div class="flex items-baseline gap-3 mb-4">
                <span class="text-2xl font-bold text-gray-900">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
                @if($product->discount > 0)
                    <span class="text-lg text-gray-500 line-through">
                        Rp {{ number_format($product->original_price, 0, ',', '.') }}
                    </span>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="mb-6">
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of Stock' }}
                </span>
            </div>

            <!-- Description -->
            <div class="prose prose-sm text-gray-500 mb-6">
                {!! $product->description !!}
            </div>

            <!-- Add to Cart Form -->
            @if($product->stock > 0)
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-24">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                            <select id="quantity" 
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-gray-500 focus:border-gray-500">
                                @for($i = 1; $i <= min($product->stock, 10); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <button onclick="addToCart({{ $product->id }}, document.getElementById('quantity').value); closeQuickView();"
                            class="w-full bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors flex items-center justify-center gap-2 relative">
                        <span class="cart-default inline-flex items-center gap-2">
                            <span>Add to Cart</span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <span class="cart-loading hidden absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                    </button>
                </div>
            @else
                <button disabled 
                        class="w-full bg-gray-100 text-gray-400 px-6 py-3 rounded-lg font-medium cursor-not-allowed">
                    Out of Stock
                </button>
            @endif
        </div>
    </div>
</div> 