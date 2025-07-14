<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Product Image -->
    <div class="relative">
        <img src="{{ $product->image_url }}" 
             alt="{{ $product->name }}" 
             class="w-full h-64 object-cover rounded-lg">
        @if($product->discount > 0)
            <div class="absolute top-2 left-2">
                <span class="bg-red-500 text-white px-2 py-1 rounded-lg text-sm font-bold">
                    -{{ $product->discount }}%
                </span>
            </div>
        @endif
    </div>

    <!-- Product Details -->
    <div>
        <div class="mb-4">
            <h2 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h2>
            <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
        </div>

        <div class="mb-4">
            <div class="flex items-baseline gap-2">
                @if($product->discount > 0)
                    <span class="text-gray-500 line-through text-sm">
                        Rp {{ number_format($product->original_price, 0, ',', '.') }}
                    </span>
                @endif
                <span class="text-2xl font-bold text-blue-600">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>
            <div class="mt-1">
                <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
                </span>
            </div>
        </div>

        <div class="prose prose-sm text-gray-600 mb-6">
            <p>{{ $product->description }}</p>
        </div>

        <!-- Product Features/Specs if any -->
        @if($product->specifications)
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">Spesifikasi</h3>
                <ul class="space-y-2">
                    @foreach(json_decode($product->specifications) as $spec)
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>{{ $spec }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <button onclick="addToCart({{ $product->id }})" 
                    {{ $product->stock <= 0 ? 'disabled' : '' }}
                    class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors duration-300">
                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
            </button>
            <button onclick="toggleWishlist({{ $product->id }})" 
                    class="px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                <i class="far fa-heart"></i>
            </button>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 grid grid-cols-3 gap-4 text-center text-sm">
            <div class="p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-truck text-blue-600 mb-1"></i>
                <p>Pengiriman Cepat</p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-shield-alt text-blue-600 mb-1"></i>
                <p>Garansi Resmi</p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-undo text-blue-600 mb-1"></i>
                <p>30 Hari Pengembalian</p>
            </div>
        </div>
    </div>
</div> 