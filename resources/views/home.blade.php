<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KopiKita</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900">

  <x-app-layout>

  <div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div class="lg:pr-12">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
            Nikmati Kopi Terbaik
            <span class="block">dari Biji Pilihan</span>
          </h1>
          <p class="mt-4 text-lg text-gray-600">
            Rasakan pengalaman kopi autentik dengan biji kopi premium yang di-roasting dengan sempurna setiap hari.
          </p>
          <div class="mt-6">
            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
              Pesan Sekarang
              <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
          </div>
        </div>
        <div class="aspect-square w-full max-w-lg mx-auto">
          <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Kopi premium" class="rounded-lg shadow-xl w-full h-full object-cover">
        </div>
      </div>

      <!-- Stats Section -->
      @auth
        @if(Auth::user()->role === 'admin')
          <div class="grid grid-cols-3 gap-8 mt-12 py-6 border-t border-b border-gray-200">
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">{{ $stats['total_customers'] ?? '0' }}</span>
              <span class="block text-sm text-gray-500 mt-1">Total Pelanggan</span>
            </div>
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">{{ $stats['total_products'] ?? '0' }}</span>
              <span class="block text-sm text-gray-500 mt-1">Varian Kopi</span>
            </div>
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</span>
              <span class="block text-sm text-gray-500 mt-1">Total Pendapatan</span>
            </div>
          </div>
        @else
          <div class="grid grid-cols-3 gap-8 mt-12 py-6 border-t border-b border-gray-200">
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">50K+</span>
              <span class="block text-sm text-gray-500 mt-1">Cangkir Disajikan</span>
            </div>
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">15+</span>
              <span class="block text-sm text-gray-500 mt-1">Varian Kopi</span>
            </div>
            <div class="text-center">
              <span class="block text-3xl font-bold text-gray-900">98%</span>
              <span class="block text-sm text-gray-500 mt-1">Tingkat Kepuasan</span>
            </div>
          </div>
        @endif
      @else
        <div class="grid grid-cols-3 gap-8 mt-12 py-6 border-t border-b border-gray-200">
          <div class="text-center">
            <span class="block text-3xl font-bold text-gray-900">50K+</span>
            <span class="block text-sm text-gray-500 mt-1">Cangkir Disajikan</span>
          </div>
          <div class="text-center">
            <span class="block text-3xl font-bold text-gray-900">15+</span>
            <span class="block text-sm text-gray-500 mt-1">Varian Kopi</span>
          </div>
          <div class="text-center">
            <span class="block text-3xl font-bold text-gray-900">98%</span>
            <span class="block text-sm text-gray-500 mt-1">Tingkat Kepuasan</span>
          </div>
        </div>
      @endauth

      <!-- Best Sellers Section -->
      <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Menu Favorit</h2>
            <select id="category-filter" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500">
              <option value="all">Semua</option>
              <option value="Espresso">Espresso</option>
              <option value="Manual Brew">Manual Brew</option>
              <option value="Signature">Signature</option>
              <option value="Non-Coffee">Non-Coffee</option>
            </select>
          </div>

          <div id="product-list" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 border border-gray-100"
                 onclick="quickView({{ $product->id }})">
              <!-- Wishlist Button -->
              <button onclick="event.stopPropagation(); toggleWishlist({{ $product->id }})" 
                      class="absolute top-3 right-3 z-10 p-2.5 bg-white rounded-full shadow-md text-gray-400 hover:text-red-500 transition-colors hover:scale-110 transform">
                <i class="fas fa-heart {{ in_array($product->id, session('wishlist', [])) ? 'text-red-500' : '' }}"></i>
              </button>

              <!-- Discount Badge -->
              @if($product->discount > 0)
                <div class="absolute top-3 left-3 z-10">
                  <span class="bg-rose-500 text-white px-3 py-1.5 text-xs font-medium rounded-full shadow-md">
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
              <div class="p-5">
                <div class="mb-3">
                  <p class="text-xs font-medium text-gray-500 mb-1.5 tracking-wider uppercase">{{ $product->category->name }}</p>
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
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                      Sold Out
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
                <span class="bg-white text-gray-900 px-4 py-2 rounded-full font-medium opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                  Lihat Detail
                </span>
              </div>
            </div>
            @endforeach
          </div>
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

      <!-- Why Choose Us -->
      <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="lg:w-1/2 lg:pr-12">
              <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Coffee Roasting" class="rounded-lg shadow-xl">
            </div>
            <div class="lg:w-1/2 mt-8 lg:mt-0">
              <h2 class="text-3xl font-bold text-gray-900">Mengapa Memilih Kami</h2>
              <div class="mt-6 space-y-6">
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">Biji Kopi Pilihan</h3>
                    <p class="mt-2 text-gray-600">Kami hanya menggunakan biji kopi terbaik dari petani lokal terpilih di seluruh Indonesia.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">Roasting Sempurna</h3>
                    <p class="mt-2 text-gray-600">Proses roasting yang presisi untuk menghasilkan karakter dan cita rasa kopi terbaik.</p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">Barista Berpengalaman</h3>
                    <p class="mt-2 text-gray-600">Tim barista kami telah tersertifikasi dan berpengalaman dalam menyajikan kopi berkualitas.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Newsletter Section -->
      <div class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
          <div class="flex flex-col lg:flex-row items-center justify-between">
            <div>
              <h2 class="text-3xl font-bold text-gray-900">Berlangganan Newsletter</h2>
              <p class="mt-4 text-lg text-gray-600">Dapatkan diskon 30% untuk pembelian pertama</p>
            </div>
            <div class="mt-8 lg:mt-0">
              <form class="flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Masukkan email Anda" class="px-5 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                  Berlangganan
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <x-footer />

    @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Category filter functionality
        const categoryFilter = document.getElementById("category-filter");
        const productList = document.getElementById("product-list");
        const originalContent = productList.innerHTML;

        categoryFilter.addEventListener("change", function (e) {
          const category = e.target.value;
          const products = productList.querySelectorAll('.group');

          products.forEach(product => {
            const productCategory = product.querySelector('.text-gray-500').textContent;
            if (category === 'all' || productCategory === category) {
              product.style.display = '';
            } else {
              product.style.display = 'none';
            }
          });
        });
      });

      // Quick View functionality
      function quickView(productId) {
        // Prevent navigation if clicking on buttons
        if (event.target.closest('button')) {
          return;
        }

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

      // Close modal when clicking outside
      document.getElementById('quickViewModal').addEventListener('click', function(e) {
        if (e.target === this) {
          closeQuickView();
        }
      });

      // Wishlist functionality
      function toggleWishlist(productId) {
        fetch(`/wishlist/toggle/${productId}`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
          },
        })
        .then(response => response.json())
        .then(data => {
          const button = event.currentTarget;
          const icon = button.querySelector('i');
          
          if (data.status === 'added') {
            icon.classList.add('text-red-500');
          } else {
            icon.classList.remove('text-red-500');
          }
        });
      }
    </script>
    @endpush
  </div>

  </x-app-layout>
</body>
</html>
