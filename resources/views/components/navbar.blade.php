<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">KopiKita</span>
                </a>
            </div>

            <!-- Center Navigation Links -->
            <div class="hidden sm:flex sm:items-center">
                <div class="flex space-x-8 h-16">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out group relative">
                        <div class="flex items-center">
                            <i class="fas fa-home {{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors mr-2"></i>
                            <span class="{{ request()->routeIs('home') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700' }}">{{ __('Home') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full border-b-4 {{ request()->routeIs('home') ? 'border-gray-900' : 'border-transparent group-hover:border-gray-300' }} transition-colors"></div>
                    </x-nav-link>

                    <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out group relative">
                        <div class="flex items-center">
                            <i class="fas fa-store {{ request()->routeIs('shop') ? 'text-gray-900' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors mr-2"></i>
                            <span class="{{ request()->routeIs('shop') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700' }}">{{ __('Shop') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full border-b-4 {{ request()->routeIs('shop') ? 'border-gray-900' : 'border-transparent group-hover:border-gray-300' }} transition-colors"></div>
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out group relative">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle {{ request()->routeIs('about') ? 'text-gray-900' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors mr-2"></i>
                            <span class="{{ request()->routeIs('about') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700' }}">{{ __('About') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full border-b-4 {{ request()->routeIs('about') ? 'border-gray-900' : 'border-transparent group-hover:border-gray-300' }} transition-colors"></div>
                    </x-nav-link>

                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out group relative">
                        <div class="flex items-center">
                            <i class="fas fa-envelope {{ request()->routeIs('contact') ? 'text-gray-900' : 'text-gray-400 group-hover:text-gray-500' }} transition-colors mr-2"></i>
                            <span class="{{ request()->routeIs('contact') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-700' }}">{{ __('Contact') }}</span>
                        </div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full border-b-4 {{ request()->routeIs('contact') ? 'border-gray-900' : 'border-transparent group-hover:border-gray-300' }} transition-colors"></div>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                @auth
                    <!-- Cart Icon for customers -->
                    @if(Auth::user()->role !== 'admin')
                        <div class="relative" x-data="{ cartOpen: false }">
                            <button @click="cartOpen = !cartOpen" 
                                    @click.away="cartOpen = false"
                                    @mouseover="cartOpen = true"
                                    class="relative p-2 text-gray-600 hover:text-blue-500 transition-colors group">
                                <a href="{{ route('cart.index') }}" class="relative inline-block">
                                    <i class="fas fa-shopping-cart text-xl transform group-hover:scale-110 transition-transform"></i>
                                    @if(session('cart'))
                                        <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">
                                            {{ count(session('cart')) }}
                                        </span>
                                    @endif
                                </a>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full border-b-2 border-transparent group-hover:border-blue-500 transition-all"></div>
                            </button>

                            <!-- Cart Preview Dropdown -->
                            <div x-show="cartOpen"
                                 x-transition:enter="cart-preview-enter"
                                 x-transition:enter-start="cart-preview-enter-active"
                                 x-transition:leave="cart-preview-exit"
                                 x-transition:leave-end="cart-preview-exit-active"
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50"
                                 style="display: none;">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Shopping Cart</h3>
                                    <div id="cartPreview">
                                        @if(session('cart') && count(session('cart')) > 0)
                                            <div class="space-y-3 max-h-60 overflow-y-auto">
                                                @foreach(session('cart') as $id => $details)
                                                    <div class="flex items-center space-x-3 border-b border-gray-100 pb-3">
                                                        <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" 
                                                             class="w-12 h-12 object-cover rounded-lg">
                                                        <div class="flex-1">
                                                            <h4 class="text-sm font-medium text-gray-900">{{ $details['name'] }}</h4>
                                                            <p class="text-sm text-gray-500">
                                                                {{ $details['quantity'] }} × Rp {{ number_format($details['price'], 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="mt-4 pt-3 border-t border-gray-100">
                                                <div class="flex justify-between items-center mb-3">
                                                    <span class="text-sm font-medium text-gray-900">Total</span>
                                                    <span class="text-sm font-bold text-gray-900">
                                                        Rp {{ number_format(array_sum(array_map(function($item) { 
                                                            return $item['price'] * $item['quantity']; 
                                                        }, session('cart'))), 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('cart.index') }}" 
                                                   class="block w-full bg-gray-900 text-white text-center py-2 px-4 rounded-lg hover:bg-gray-800 transition-colors">
                                                    View Cart
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <i class="fas fa-shopping-basket text-4xl text-gray-300 mb-3"></i>
                                                <p class="text-gray-500">Your cart is empty</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button 
                            id="profileButton"
                            type="button"
                            class="flex items-center space-x-3 focus:outline-none hover:text-gray-700 px-3 py-2 rounded-lg transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                             alt="{{ Auth::user()->name }}" 
                                             class="h-9 w-9 rounded-full object-cover border-2 border-gray-200">
                                    @else
                                        <div class="h-9 w-9 rounded-full bg-gray-900 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-green-400"></div>
                                </div>
                                <div class="text-left">
                                    <h2 class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Customer' }}</p>
                                </div>
                            </div>
                            <i id="profileChevron" class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-50 ring-1 ring-black ring-opacity-5">
                            <div class="px-4 py-2 border-b">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-tachometer-alt w-5 inline-block text-gray-400"></i>
                                    {{ __('Dashboard') }}
                                </a>
                            @else
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-shopping-bag w-5 inline-block text-gray-400"></i>
                                    {{ __('My Orders') }}
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fas fa-user w-5 inline-block text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>

                            <a href="{{ route('profile.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <i class="fas fa-cog w-5 inline-block text-gray-400"></i>
                                {{ __('Settings') }}
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt w-5 inline-block"></i>
                                {{ __('Log Out') }}
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <div class="space-x-3">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg transition-colors shadow-md hover:shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button id="hamburgerButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="hamburgerOpen" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="hamburgerClose" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- Menu navigasi responsif, disembunyikan secara default dan hanya muncul pada layar kecil --}}
    <div id="responsiveMenu" class="hidden sm:hidden">
        
        {{-- Container utama untuk link navigasi utama --}}
        <div class="pt-2 pb-3 space-y-1">
            
            {{-- Link ke halaman Home --}}
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="flex items-center space-x-2">
                <i class="fas fa-home text-gray-400"></i>
                <span>{{ __('Home') }}</span>
            </x-responsive-nav-link>

            {{-- Link ke halaman Shop --}}
            <x-responsive-nav-link :href="route('shop')" :active="request()->routeIs('shop')" class="flex items-center space-x-2">
                <i class="fas fa-store text-gray-400"></i>
                <span>{{ __('Shop') }}</span>
            </x-responsive-nav-link>

            {{-- Link ke halaman About --}}
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="flex items-center space-x-2">
                <i class="fas fa-info-circle text-gray-400"></i>
                <span>{{ __('About') }}</span>
            </x-responsive-nav-link>

            {{-- Link ke halaman Contact --}}
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="flex items-center space-x-2">
                <i class="fas fa-envelope text-gray-400"></i>
                <span>{{ __('Contact') }}</span>
            </x-responsive-nav-link>

            {{-- Jika user sedang login --}}
            @auth

                {{-- Jika role user adalah admin, tampilkan link dashboard admin --}}
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard*')" class="flex items-center space-x-2">
                        <i class="fas fa-tachometer-alt text-gray-400"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </x-responsive-nav-link>

                {{-- Jika bukan admin (customer biasa) tampilkan menu order dan cart --}}
                @else
                    {{-- Link ke halaman "My Orders" --}}
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders*')" class="flex items-center space-x-2">
                        <i class="fas fa-shopping-bag text-gray-400"></i>
                        <span>{{ __('My Orders') }}</span>
                    </x-responsive-nav-link>

                    {{-- Link ke halaman Shopping Cart --}}
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart*')" class="flex items-center space-x-2">
                        <i class="fas fa-shopping-cart text-gray-400"></i>
                        <span>{{ __('Shopping Cart') }}</span>

                        {{-- Tampilkan jumlah item dalam cart jika ada data di session --}}
                        @if(session('cart'))
                            <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold ml-2">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        {{-- Bagian menu pengaturan user dan logout/login --}}
        <!-- Responsive Settings Options -->
        @auth
            {{-- Jika user login, tampilkan data user dan link profile + logout --}}
            <div class="pt-4 pb-1 border-t border-gray-200">
                
                {{-- Menampilkan foto profil user atau inisial nama jika tidak ada foto --}}
                <div class="flex items-center px-4 space-x-3">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                            alt="{{ Auth::user()->name }}" 
                            class="h-10 w-10 rounded-full object-cover border-2 border-gray-200">
                    @else
                        <div class="h-10 w-10 rounded-full bg-gray-900 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- Menampilkan nama dan email user --}}
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                {{-- Link menuju edit profile dan settings --}}
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center space-x-2">
                        <i class="fas fa-user text-gray-400"></i>
                        <span>{{ __('Profile') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.settings')" class="flex items-center space-x-2">
                        <i class="fas fa-cog text-gray-400"></i>
                        <span>{{ __('Settings') }}</span>
                    </x-responsive-nav-link>

                    {{-- Form logout (dengan POST method, karena logout tidak boleh GET) --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="flex items-center space-x-2 text-red-600">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{ __('Log Out') }}</span>
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>

        @else
            {{-- Jika user belum login, tampilkan link login dan register --}}
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="space-y-1">
                    {{-- Link login --}}
                    <x-responsive-nav-link :href="route('login')" class="flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt text-gray-400"></i>
                        <span>{{ __('Login') }}</span>
                    </x-responsive-nav-link>

                    {{-- Link register --}}
                    <x-responsive-nav-link :href="route('register')" class="flex items-center space-x-2">
                        <i class="fas fa-user-plus text-gray-400"></i>
                        <span>{{ __('Register') }}</span>
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>

</nav>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add cart preview update function
    window.updateCartPreview = function(cartData) {
        const cartPreview = document.querySelector('#cartPreview');
        if (!cartPreview) return;

        if (!cartData || Object.keys(cartData).length === 0) {
            cartPreview.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-shopping-basket text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Your cart is empty</p>
                </div>
            `;
            return;
        }

        let total = 0;
        let cartHtml = '<div class="space-y-3 max-h-60 overflow-y-auto">';
        
        Object.entries(cartData).forEach(([id, details]) => {
            const itemTotal = details.price * details.quantity;
            total += itemTotal;
            
            cartHtml += `
                <div class="flex items-center space-x-3 border-b border-gray-100 pb-3">
                    <img src="${details.image}" alt="${details.name}" 
                         class="w-12 h-12 object-cover rounded-lg">
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">${details.name}</h4>
                        <p class="text-sm text-gray-500">
                            ${details.quantity} × Rp ${new Intl.NumberFormat('id-ID').format(details.price)}
                        </p>
                    </div>
                </div>
            `;
        });

        cartHtml += `</div>
            <div class="mt-4 pt-3 border-t border-gray-100">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-medium text-gray-900">Total</span>
                    <span class="text-sm font-bold text-gray-900">
                        Rp ${new Intl.NumberFormat('id-ID').format(total)}
                    </span>
                </div>
                <a href="{{ route('cart.index') }}" 
                   class="block w-full bg-gray-900 text-white text-center py-2 px-4 rounded-lg hover:bg-gray-800 transition-colors">
                    View Cart
                </a>
            </div>`;

        cartPreview.innerHTML = cartHtml;
    };

    // Profile Dropdown
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');
    const profileChevron = document.getElementById('profileChevron');
    let isProfileOpen = false;

    function toggleProfile(event) {
        if (event) {
            event.stopPropagation();
        }
        isProfileOpen = !isProfileOpen;
        profileDropdown.classList.toggle('hidden', !isProfileOpen);
        profileChevron.classList.toggle('transform', isProfileOpen);
        profileChevron.classList.toggle('rotate-180', isProfileOpen);
    }

    // Toggle dropdown when clicking profile button
    if (profileButton) {
        profileButton.addEventListener('click', toggleProfile);
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = profileDropdown.contains(event.target) || profileButton.contains(event.target);
        if (!isClickInside && !profileDropdown.classList.contains('hidden')) {
            toggleProfile();
        }
    });

    // Close dropdown when pressing Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && isProfileOpen) {
            toggleProfile();
        }
    });

    // Hamburger Menu
    const hamburgerButton = document.getElementById('hamburgerButton');
    const responsiveMenu = document.getElementById('responsiveMenu');
    const hamburgerOpen = document.getElementById('hamburgerOpen');
    const hamburgerClose = document.getElementById('hamburgerClose');
    let isMenuOpen = false;

    hamburgerButton.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            responsiveMenu.classList.remove('hidden');
            hamburgerOpen.classList.add('hidden');
            hamburgerClose.classList.remove('hidden');
        } else {
            responsiveMenu.classList.add('hidden');
            hamburgerOpen.classList.remove('hidden');
            hamburgerClose.classList.add('hidden');
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.cart-preview-enter {
    opacity: 0;
    transform: scale(0.95);
}
.cart-preview-enter-active {
    opacity: 1;
    transform: scale(1);
    transition: opacity 200ms ease-out, transform 200ms ease-out;
}
.cart-preview-exit {
    opacity: 1;
    transform: scale(1);
}
.cart-preview-exit-active {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 100ms ease-in, transform 100ms ease-in;
}
</style>
@endpush