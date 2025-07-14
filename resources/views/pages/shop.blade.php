<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KopiKita</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <x-app-layout>

        <!-- Hero Section with Featured Products -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                        Menu Pilihan
                    </h1>
                    <p class="mt-4 text-xl text-gray-300">
                        Temukan berbagai pilihan kopi premium kami
                    </p>
                </div>

                <!-- Featured Products Slider -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                    <div class="group relative">
                        <div class="relative aspect-square overflow-hidden rounded-lg bg-gray-800">
                            <img src="{{ $product->image_url }}" 
                                 alt="{{ $product->name }}"
                                 class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity">
                            @if($product->discount > 0)
                                <div class="absolute top-2 left-2">
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
                                        -{{ $product->discount }}%
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-medium text-white">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-400">{{ $product->category->name }}</p>
                            <div class="mt-2">
                                @if($product->discount > 0)
                                    <span class="text-sm text-gray-400 line-through">
                                        Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                    </span>
                                @endif
                                <span class="text-lg font-bold text-white">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Category Pills -->
            <div class="flex overflow-x-auto pb-4 hide-scrollbar mb-8">
                <button onclick="setCategory('')" 
                        class="shrink-0 px-4 py-2 rounded-full {{ !request('category') ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }} mr-2">
                    Semua Menu
                </button>
                @foreach($categories as $category)
                <button onclick="setCategory('{{ $category->id }}')"
                        class="shrink-0 px-4 py-2 rounded-full {{ request('category') == $category->id ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }} mr-2">
                    {{ $category->name }}
                    <span class="ml-1 text-sm opacity-75">({{ $category->products_count }})</span>
                </button>
                @endforeach
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" 
                               id="search" 
                               name="search" 
                               placeholder="Cari menu..." 
                               value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <select id="price_range" name="price_range" class="w-full py-2.5 pl-3 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                            <option value="">Semua Harga</option>
                            <option value="0-25000" {{ request('price_range') == '0-25000' ? 'selected' : '' }}>Di bawah Rp 25.000</option>
                            <option value="25000-50000" {{ request('price_range') == '25000-50000' ? 'selected' : '' }}>Rp 25.000 - Rp 50.000</option>
                            <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>Rp 50.000 - Rp 100.000</option>
                            <option value="100000-0" {{ request('price_range') == '100000-0' ? 'selected' : '' }}>Di atas Rp 100.000</option>
                        </select>
                    </div>

                    <!-- Stock Status -->
                    <div>
                        <select id="stock_status" name="stock_status" class="w-full py-2.5 pl-3 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                            <option value="">Status Ketersediaan</option>
                            <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Tersedia</option>
                            <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Habis</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div>
                        <select id="sort" name="sort" class="w-full py-2.5 pl-3 pr-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Menu Terbaru</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama: A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama: Z-A</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Active Filters -->
            @if(request('search') || request('category') || request('price_range') || request('stock_status'))
                <div class="flex flex-wrap gap-2 mb-6">
                    @if(request('search'))
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Pencarian: {{ request('search') }}
                            <button onclick="removeFilter('search')" class="ml-2 text-gray-600 hover:text-gray-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif

                    @if(request('category'))
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Kategori: {{ $categories->find(request('category'))->name }}
                            <button onclick="removeFilter('category')" class="ml-2 text-gray-600 hover:text-gray-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif

                    @if(request('price_range'))
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Rentang Harga: {{ str_replace('-', ' - ', request('price_range')) }}
                            <button onclick="removeFilter('price_range')" class="ml-2 text-gray-600 hover:text-gray-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif

                    @if(request('stock_status'))
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Status: {{ request('stock_status') === 'in_stock' ? 'Tersedia' : 'Habis' }}
                            <button onclick="removeFilter('stock_status')" class="ml-2 text-gray-600 hover:text-gray-800">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endif
                </div>
            @endif

            <!-- Products Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 border border-gray-200"
                         onclick="quickView({{ $product->id }})">
                        
                        <button onclick="event.stopPropagation(); toggleWishlist({{ $product->id }})" 
                                class="absolute top-3 right-3 z-10 p-2.5 bg-white rounded-full shadow-lg text-gray-400 hover:text-red-500 transition-colors hover:scale-110 transform">
                            <i class="fas fa-heart {{ in_array($product->id, session('wishlist', [])) ? 'text-red-500' : '' }}"></i>
                        </button>

                        <!-- Discount Badge -->
                        @if($product->discount > 0)
                            <div class="absolute top-3 left-3 z-10">
                                <span class="bg-rose-500 text-white px-3 py-1.5 text-xs font-medium rounded-full shadow-lg">
                                    -{{ $product->discount }}%
                                </span>
                            </div>
                        @endif

                        <!-- Product Image -->
                        <div class="relative aspect-square bg-white p-6 group-hover:bg-gray-50 transition-colors duration-300">
                            <img src="{{ $product->image_url }}" 
                                 alt="{{ $product->name }}" 
                                 class="h-full w-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                        </div>

                        <!-- Product Info -->
                        <div class="p-5 bg-gray-50">
                            <div class="mb-3">
                                <p class="text-xs font-medium text-gray-600 mb-1.5 tracking-wider uppercase">{{ $product->category->name }}</p>
                                <h3 class="font-medium text-gray-900 line-clamp-1 group-hover:text-gray-700 transition-colors">{{ $product->name }}</h3>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    @if($product->discount > 0)
                                        <span class="text-sm text-gray-500 line-through mb-0.5">
                                            Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    <span class="text-lg font-semibold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                @if($product->stock <= 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-800">
                                        Habis
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Quick View Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 pointer-events-none transition-all duration-300 flex items-center justify-center">
                            <span class="bg-white text-gray-900 px-4 py-2 rounded-full font-medium opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                                Lihat Detail
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-coffee text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Quick View Modal -->
        <div id="quickViewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl max-w-4xl w-full mx-4 overflow-hidden">
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-xl font-semibold text-gray-900">Product Details</h3>
                    <button onclick="closeQuickView()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="quickViewContent" class="p-6">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>

        @push('styles')
        <style>
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
        @endpush

        @push('scripts')
        <script>
            // Filter handling
            const filterInputs = ['search', 'category', 'price_range', 'sort', 'stock_status'];
            filterInputs.forEach(input => {
                const element = document.getElementById(input);
                if (element) {
                    element.addEventListener('change', applyFilters);
                }
            });

            function setCategory(categoryId) {
                document.getElementById('category').value = categoryId;
                applyFilters();
            }

            function applyFilters() {
                let url = new URL(window.location.href);
                filterInputs.forEach(input => {
                    const element = document.getElementById(input);
                    if (element) {
                        const value = element.value;
                        if (value) {
                            url.searchParams.set(input, value);
                        } else {
                            url.searchParams.delete(input);
                        }
                    }
                });
                window.location.href = url.toString();
            }

            function removeFilter(filter) {
                const element = document.getElementById(filter);
                if (element) {
                    element.value = '';
                    applyFilters();
                }
            }

            // Quick View handling
            function quickView(productId) {
                const modal = document.getElementById('quickViewModal');
                const content = document.getElementById('quickViewContent');

                content.innerHTML = `
                    <div class="flex items-center justify-center p-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900"></div>
                    </div>
                `;
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                fetch(`/shop/quick-view/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            content.innerHTML = data.html;
                        }
                    })
                    .catch(error => {
                        content.innerHTML = `
                            <div class="text-center text-red-600 p-4">
                                Failed to load product details
                            </div>
                        `;
                    });
            }

            function closeQuickView() {
                const modal = document.getElementById('quickViewModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Cart handling with improved feedback
            function addToCart(productId, quantity = 1) {
                const button = event.target.closest('button');
                const cartIcon = button.querySelector('.fa-shopping-cart');
                const loadingIcon = button.querySelector('.cart-loading');
                
                // Show loading state
                cartIcon.classList.add('hidden');
                loadingIcon.classList.remove('hidden');
                button.disabled = true;

                fetch(`/shop/add-to-cart/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count
                        const cartCount = document.querySelector('#cartCount');
                        if (cartCount) {
                            cartCount.textContent = data.cartCount;
                        }

                        // Update cart preview if the function exists
                        if (window.updateCartPreview && data.cartData) {
                            window.updateCartPreview(data.cartData);
                        }

                        // Show success animation
                        cartIcon.classList.remove('fa-shopping-cart');
                        cartIcon.classList.add('fa-check');
                        cartIcon.classList.remove('hidden');
                        loadingIcon.classList.add('hidden');
                        button.classList.add('text-green-500');

                        // Reset button after 1.5 seconds
                        setTimeout(() => {
                            cartIcon.classList.remove('fa-check');
                            cartIcon.classList.add('fa-shopping-cart');
                            button.classList.remove('text-green-500');
                            button.disabled = false;
                        }, 1500);

                        // Show success notification
                        showNotification('Success', data.message, 'success');
                    } else {
                        // Show error state
                        cartIcon.classList.remove('hidden');
                        loadingIcon.classList.add('hidden');
                        button.classList.add('text-red-500');
                        button.disabled = false;

                        // Reset error state after 1.5 seconds
                        setTimeout(() => {
                            button.classList.remove('text-red-500');
                        }, 1500);

                        showNotification('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    // Show error state
                    cartIcon.classList.remove('hidden');
                    loadingIcon.classList.add('hidden');
                    button.classList.add('text-red-500');
                    button.disabled = false;

                    // Reset error state after 1.5 seconds
                    setTimeout(() => {
                        button.classList.remove('text-red-500');
                    }, 1500);

                    showNotification('Error', 'Failed to add product to cart', 'error');
                });
            }

            // Wishlist handling
            function toggleWishlist(productId) {
                fetch(`/shop/toggle-wishlist/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const wishlistIcon = event.target.closest('button').querySelector('i');
                        if (data.isWishlisted) {
                            wishlistIcon.classList.add('text-red-500');
                        } else {
                            wishlistIcon.classList.remove('text-red-500');
                        }
                        showNotification('Success', data.message, 'success');
                    }
                });
            }

            // Notification handling
            function showNotification(title, message, type = 'success') {
                const notificationContainer = document.createElement('div');
                notificationContainer.className = `fixed top-2 right-2 bg-white rounded-md shadow-lg p-3 flex items-start space-x-2 z-50 transform transition-transform duration-300 translate-x-full max-w-xs ${
                    type === 'success' ? 'border-l-2 border-green-500' : 'border-l-2 border-red-500'
                }`;
                
                notificationContainer.innerHTML = `
                    <div class="${type === 'success' ? 'text-green-500' : 'text-red-500'}">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-base"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-gray-900 text-sm">${title}</h3>
                        <p class="text-xs text-gray-500 truncate">${message}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-500 flex-shrink-0 -mt-1 -mr-1 ml-2">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                `;

                document.body.appendChild(notificationContainer);
                
                // Slide in animation
                requestAnimationFrame(() => {
                    notificationContainer.classList.remove('translate-x-full');
                });

                // Auto remove after 3 seconds
                setTimeout(() => {
                    notificationContainer.classList.add('translate-x-full');
                    setTimeout(() => notificationContainer.remove(), 300);
                }, 3000);
            }

            // Close modal when clicking outside
            document.getElementById('quickViewModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeQuickView();
                }
            });

            // Close modal with escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeQuickView();
                }
            });
        </script>
        @endpush
    </x-app-layout>
</body>
</html>
