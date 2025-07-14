@extends('layouts.customer')

@php($title = 'Toko Online')

@section('content')
  <!-- Notification Area -->
  <div id="notification" class="fixed top-4 right-4 z-50 hidden">
    <div id="notificationContent" class="px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 min-w-80">
      <div id="notificationIcon" class="flex-shrink-0">
        <!-- Icon will be inserted here -->
      </div>
      <div>
        <div id="notificationTitle" class="font-semibold text-sm"></div>
        <div id="notificationMessage" class="text-sm opacity-90"></div>
      </div>
      <button id="closeNotification" class="ml-4 text-white hover:text-gray-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Header Section -->
  <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-8 mb-8">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold mb-2">Toko Online</h1>
          <p class="text-blue-100">Temukan produk terbaik untuk kebutuhan Anda</p>
        </div>
        <div class="flex items-center space-x-4">
          <!-- Shopping Cart -->
          <button id="cartToggle" class="relative bg-white/20 hover:bg-white/30 p-3 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5 3H3m4 10v6a2 2 0 002 2h8a2 2 0 002-2v-6m-4 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4"></path>
            </svg>
            <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Search and Filter Section -->
  <div class="container mx-auto px-4 mb-8">
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
      <form action="{{ route('shop.index') }}" method="GET" class="flex items-center space-x-2 w-full md:w-1/2">
        <input 
          type="text" 
          name="search" 
          value="{{ request('search') }}" 
          placeholder="Cari produk..." 
          class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
          Cari
        </button>
      </form>
      
      <div class="flex items-center space-x-4">
        <select id="categoryFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">Semua Kategori</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        
        <select id="sortFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
          <option value="">Urutkan</option>
          <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
          <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
          <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama: A-Z</option>
          <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama: Z-A</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Products Grid -->
  <div class="container mx-auto px-4">
    @if($products->count() > 0)
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @foreach($products as $product)
          <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
            <!-- Product Image -->
            <div class="relative h-48 bg-gray-200">
              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
              @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                  <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
              @endif
              
              @if($product->stock <= 5 && $product->stock > 0)
                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded">
                  Stok Terbatas
                </div>
              @elseif($product->stock == 0)
                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">
                  Habis
                </div>
              @endif
            </div>

            <!-- Product Details -->
            <div class="p-4">
              <div class="mb-2">
                <span class="text-sm text-gray-500">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
              </div>
              
              <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $product->name }}</h3>
              <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
              
              <div class="flex items-center justify-between mb-4">
                <div class="text-2xl font-bold text-blue-600">
                  Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">
                  Stok: {{ $product->stock }}
                </div>
              </div>

              <!-- Add to Cart Section -->
              <div class="flex items-center space-x-2">
                <div class="flex items-center border border-gray-300 rounded">
                  <button 
                    type="button" 
                    class="quantity-decrease px-3 py-1 hover:bg-gray-100"
                    data-product-id="{{ $product->id }}"
                  >-</button>
                  <input 
                    type="number" 
                    class="quantity-input w-16 text-center border-0 focus:ring-0" 
                    value="1" 
                    min="1" 
                    max="{{ $product->stock }}"
                    data-product-id="{{ $product->id }}"
                  />
                  <button 
                    type="button" 
                    class="quantity-increase px-3 py-1 hover:bg-gray-100"
                    data-product-id="{{ $product->id }}"
                  >+</button>
                </div>
                
                <button 
                  class="flex-1 add-to-cart-btn bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                  data-product-id="{{ $product->id }}"
                  data-product-name="{{ $product->name }}"
                  data-product-price="{{ $product->price }}"
                  data-product-image="{{ $product->image }}"
                  data-product-stock="{{ $product->stock }}"
                  {{ $product->stock == 0 ? 'disabled' : '' }}
                >
                  @if($product->stock == 0)
                    Habis
                  @else
                    Tambah
                  @endif
                </button>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mb-8">
        {{ $products->links() }}
      </div>
    @else
      <div class="text-center py-16">
        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
        <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
      </div>
    @endif
  </div>

  <!-- Shopping Cart Sidebar -->
  <div id="cartSidebar" class="fixed inset-y-0 right-0 w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="h-full flex flex-col">
      <!-- Cart Header -->
      <div class="flex items-center justify-between p-6 border-b">
        <h2 class="text-xl font-semibold">Keranjang Belanja</h2>
        <button id="closeCart" class="text-gray-400 hover:text-gray-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Cart Items -->
      <div id="cartItems" class="flex-1 overflow-y-auto p-6">
        <div id="emptyCart" class="text-center py-16">
          <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5 3H3m4 10v6a2 2 0 002 2h8a2 2 0 002-2v-6"></path>
          </svg>
          <p class="text-gray-500">Keranjang Anda kosong</p>
        </div>
      </div>

      <!-- Cart Footer -->
      <div id="cartFooter" class="border-t p-6 hidden">
        <div class="space-y-4">
          <div class="flex justify-between items-center text-lg font-semibold">
            <span>Total:</span>
            <span id="cartTotal">Rp 0</span>
          </div>
          <button id="checkoutBtn" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition-colors">
            Checkout
          </button>
          <button id="clearCartBtn" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-medium transition-colors">
            Kosongkan Keranjang
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Cart Overlay -->
  <div id="cartOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

  <!-- Checkout Modal -->
  <div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-60 hidden">
    <div class="bg-white w-full max-w-2xl mx-4 rounded-lg shadow-xl">
      <div class="p-6 border-b">
        <h3 class="text-xl font-semibold">Checkout</h3>
      </div>
      
      <form id="checkoutForm" class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="customer_name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="customer_email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
            <input type="tel" name="customer_phone" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
            <select name="payment_method" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
              <option value="">Pilih Metode Pembayaran</option>
              <option value="transfer">Transfer Bank</option>
              <option value="cod">Bayar di Tempat (COD)</option>
              <option value="ewallet">E-Wallet</option>
            </select>
          </div>
        </div>
        
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman</label>
          <textarea name="shipping_address" required rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" placeholder="Masukkan alamat lengkap untuk pengiriman"></textarea>
        </div>

        <!-- Order Summary -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
          <h4 class="font-medium mb-3">Ringkasan Pesanan</h4>
          <div id="checkoutItems" class="space-y-2 mb-4">
            <!-- Items will be populated by JavaScript -->
          </div>
          <div class="border-t pt-2">
            <div class="flex justify-between font-semibold">
              <span>Total:</span>
              <span id="checkoutTotal">Rp 0</span>
            </div>
          </div>
        </div>

        <div class="flex space-x-4">
          <button type="button" id="cancelCheckout" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 rounded-lg font-medium transition-colors">
            Batal
          </button>
          <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition-colors">
            Buat Pesanan
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
    // Shopping cart state
    let cart = JSON.parse(localStorage.getItem('shopping_cart') || '[]');

    // Elements
    const cartToggle = document.getElementById('cartToggle');
    const cartSidebar = document.getElementById('cartSidebar');
    const cartOverlay = document.getElementById('cartOverlay');
    const closeCart = document.getElementById('closeCart');
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');
    const cartFooter = document.getElementById('cartFooter');
    const emptyCart = document.getElementById('emptyCart');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const clearCartBtn = document.getElementById('clearCartBtn');
    const checkoutModal = document.getElementById('checkoutModal');
    const checkoutForm = document.getElementById('checkoutForm');
    const cancelCheckout = document.getElementById('cancelCheckout');

    // Notification function
    function showNotification(type, title, message) {
        const notification = document.getElementById('notification');
        const notificationContent = document.getElementById('notificationContent');
        const notificationIcon = document.getElementById('notificationIcon');
        const notificationTitle = document.getElementById('notificationTitle');
        const notificationMessage = document.getElementById('notificationMessage');

        let bgColor, textColor, icon;
        switch(type) {
            case 'success':
                bgColor = 'bg-green-500';
                textColor = 'text-white';
                icon = '<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                break;
            case 'error':
                bgColor = 'bg-red-500';
                textColor = 'text-white';
                icon = '<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
                break;
            case 'info':
                bgColor = 'bg-blue-500';
                textColor = 'text-white';
                icon = '<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                break;
        }

        notificationContent.className = `px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 min-w-80 ${bgColor} ${textColor}`;
        notificationIcon.innerHTML = icon;
        notificationTitle.textContent = title;
        notificationMessage.textContent = message;

        notification.classList.remove('hidden');

        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    }

    // Close notification
    document.getElementById('closeNotification').addEventListener('click', () => {
        document.getElementById('notification').classList.add('hidden');
    });

    // Update cart display
    function updateCartDisplay() {
        cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
        
        if (cart.length === 0) {
            emptyCart.classList.remove('hidden');
            cartFooter.classList.add('hidden');
            cartItems.innerHTML = '<div id="emptyCart" class="text-center py-16"><svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5 3H3m4 10v6a2 2 0 002 2h8a2 2 0 002-2v-6"></path></svg><p class="text-gray-500">Keranjang Anda kosong</p></div>';
        } else {
            emptyCart.classList.add('hidden');
            cartFooter.classList.remove('hidden');
            
            let total = 0;
            cartItems.innerHTML = cart.map(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                return `
                    <div class="flex items-center space-x-4 py-4 border-b">
                        <img src="${item.image ? '/storage/' + item.image : '/placeholder.jpg'}" alt="${item.name}" class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h4 class="font-medium">${item.name}</h4>
                            <p class="text-sm text-gray-500">Rp ${item.price.toLocaleString('id-ID')}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <button class="cart-decrease bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded flex items-center justify-center" data-product-id="${item.id}">-</button>
                                <span class="w-8 text-center">${item.quantity}</span>
                                <button class="cart-increase bg-gray-200 hover:bg-gray-300 w-8 h-8 rounded flex items-center justify-center" data-product-id="${item.id}">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium">Rp ${itemTotal.toLocaleString('id-ID')}</p>
                            <button class="remove-from-cart text-red-500 hover:text-red-700 text-sm mt-1" data-product-id="${item.id}">Hapus</button>
                        </div>
                    </div>
                `;
            }).join('');
            
            cartTotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }
        
        // Save to localStorage
        localStorage.setItem('shopping_cart', JSON.stringify(cart));
        
        // Add event listeners for cart buttons
        addCartEventListeners();
    }

    // Add event listeners for cart buttons
    function addCartEventListeners() {
        document.querySelectorAll('.cart-increase').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = parseInt(this.dataset.productId);
                const item = cart.find(i => i.id === productId);
                if (item && item.quantity < item.stock) {
                    item.quantity++;
                    updateCartDisplay();
                }
            });
        });

        document.querySelectorAll('.cart-decrease').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = parseInt(this.dataset.productId);
                const item = cart.find(i => i.id === productId);
                if (item && item.quantity > 1) {
                    item.quantity--;
                    updateCartDisplay();
                }
            });
        });

        document.querySelectorAll('.remove-from-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = parseInt(this.dataset.productId);
                cart = cart.filter(i => i.id !== productId);
                updateCartDisplay();
                showNotification('info', 'Dihapus!', 'Produk dihapus dari keranjang');
            });
        });
    }

    // Quantity controls for product cards
    document.querySelectorAll('.quantity-increase').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const input = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
            const max = parseInt(input.getAttribute('max'));
            const current = parseInt(input.value);
            if (current < max) {
                input.value = current + 1;
            }
        });
    });

    document.querySelectorAll('.quantity-decrease').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const input = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
            }
        });
    });

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = parseInt(this.dataset.productId);
            const productName = this.dataset.productName;
            const productPrice = parseFloat(this.dataset.productPrice);
            const productImage = this.dataset.productImage;
            const productStock = parseInt(this.dataset.productStock);
            const quantityInput = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
            const quantity = parseInt(quantityInput.value);

            // Check if product already in cart
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                const newQuantity = existingItem.quantity + quantity;
                if (newQuantity <= productStock) {
                    existingItem.quantity = newQuantity;
                    showNotification('success', 'Berhasil!', `${productName} ditambahkan ke keranjang`);
                } else {
                    showNotification('error', 'Gagal!', 'Jumlah melebihi stok yang tersedia');
                    return;
                }
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    stock: productStock,
                    quantity: quantity
                });
                showNotification('success', 'Berhasil!', `${productName} ditambahkan ke keranjang`);
            }

            // Reset quantity input
            quantityInput.value = 1;
            updateCartDisplay();
        });
    });

    // Cart sidebar functionality
    cartToggle.addEventListener('click', () => {
        cartSidebar.classList.remove('translate-x-full');
        cartOverlay.classList.remove('hidden');
    });

    closeCart.addEventListener('click', () => {
        cartSidebar.classList.add('translate-x-full');
        cartOverlay.classList.add('hidden');
    });

    cartOverlay.addEventListener('click', () => {
        cartSidebar.classList.add('translate-x-full');
        cartOverlay.classList.add('hidden');
    });

    // Clear cart
    clearCartBtn.addEventListener('click', () => {
        if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
            cart = [];
            updateCartDisplay();
            showNotification('info', 'Dikosongkan!', 'Keranjang berhasil dikosongkan');
        }
    });
