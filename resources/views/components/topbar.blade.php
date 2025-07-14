<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- Link ke Font Awesome CDN -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Tailwind CSS (jika belum ada) -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  
  <style>
    #dropdownToggle:focus {
      outline: none;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="h-16 max-w-full mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <!-- Left side -->
      <div class="flex items-center space-x-3">
        <!-- Breadcrumbs -->
        <nav class="hidden sm:flex" aria-label="Breadcrumb">
          <ol class="flex items-center space-x-2 text-sm font-medium">
            <li>
              <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-indigo-600 transition-colors">
                <i class="fas fa-home"></i>
                <span class="ml-1">Dashboard</span>
              </a>
            </li>
            @if(request()->is('dashboard/products*'))
              <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('dashboard.products.index') }}" class="text-indigo-600">Produk</a>
              </li>
            @elseif(request()->is('dashboard/transactions*'))
              <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('dashboard.transactions.index') }}" class="text-indigo-600">Transaksi</a>
              </li>
            @elseif(request()->is('dashboard/customers*'))
              <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('dashboard.customers.index') }}" class="text-indigo-600">Pelanggan</a>
              </li>
            @elseif(request()->is('dashboard/reports*'))
              <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                <a href="{{ route('dashboard.reports.index') }}" class="text-indigo-600">Laporan</a>
              </li>
            @endif
          </ol>
        </nav>
      </div>

      <!-- Right side -->
      <div class="flex items-center space-x-6">
        <!-- Search -->
        <div class="hidden md:flex items-center">
            <div class="relative">
                <input type="text" 
                       placeholder="Search..." 
                       class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        @if(Auth::user() && Auth::user()->role === 'admin')
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" 
                  class="p-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-100 rounded-full transition-colors relative">
            <i class="fas fa-bell text-xl"></i>
            @php $notifCount = Auth::user()->unreadNotifications->count(); @endphp
            @if($notifCount > 0)
            <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 border-2 border-white rounded-full text-xs text-white flex items-center justify-center">
              {{ $notifCount }}
            </span>
            @endif
          </button>

          <!-- Notifications Dropdown -->
          <div x-show="open" 
               @click.away="open = false"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-3 w-80 bg-white rounded-lg shadow-lg py-1 z-50"
               style="display: none;">
            <div class="px-4 py-2 border-b border-gray-100">
              <h3 class="text-sm font-semibold text-gray-900">Notifikasi Pesanan Baru</h3>
            </div>
            <div class="max-h-64 overflow-y-auto">
              @forelse(Auth::user()->unreadNotifications as $notification)
                <a href="{{ route('dashboard.transactions.show', $notification->data['order_id']) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors notif-link" data-notif-id="{{ $notification->id }}">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-500 flex items-center justify-center">
                        <i class="fas fa-shopping-cart"></i>
                      </span>
                    </div>
                    <div class="ml-3 flex-1">
                      <p class="text-sm font-medium text-gray-900">Order #{{ $notification->data['order_id'] ?? '-' }}</p>
                      <p class="text-xs text-gray-500 mt-0.5">Total: Rp{{ number_format($notification->data['total'] ?? 0,0,',','.') }}</p>
                      <p class="text-xs text-gray-400 mt-0.5">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                  </div>
                </a>
              @empty
                <div class="px-4 py-3 text-sm text-gray-500">Tidak ada notifikasi baru.</div>
              @endforelse
            </div>
            <div class="px-4 py-2 border-t border-gray-100 bg-gray-50">
              <a href="#" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                Lihat semua notifikasi
              </a>
            </div>
          </div>
        </div>
        @endif

        <!-- Profile Dropdown -->
        @auth
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" 
                  class="flex items-center space-x-3 focus:outline-none">
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
              <div class="hidden md:block text-left">
                <h2 class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Customer' }}</p>
              </div>
            </div>
            <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-200"
               :class="{ 'transform rotate-180': open }"></i>
          </button>

          <!-- Profile Dropdown Menu -->
          <div x-show="open" 
               @click.away="open = false"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-50 ring-1 ring-black ring-opacity-5"
               style="display: none;">
            <div class="px-4 py-2 border-b">
              <p class="text-xs text-gray-500">Logged in as</p>
              <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
            </div>
            
            <div class="py-1">
              <a href="{{ route('home') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-store w-5 h-5 text-gray-400 group-hover:text-gray-500"></i>
                <span class="ml-3">View Store</span>
              </a>
              
              <a href="{{ route('profile.edit') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-user w-5 h-5 text-gray-400 group-hover:text-gray-500"></i>
                <span class="ml-3">Profile</span>
              </a>
              
              <a href="{{ route('profile.settings') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-cog w-5 h-5 text-gray-400 group-hover:text-gray-500"></i>
                <span class="ml-3">Settings</span>
              </a>
            </div>
            
            <div class="py-1 border-t border-gray-100">
              <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" 
                        @click.prevent="$root.submit();"
                        class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                  <i class="fas fa-sign-out-alt w-5 h-5 text-red-400 group-hover:text-red-500"></i>
                  <span class="ml-3">Log Out</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        @else
        <div class="flex items-center space-x-4">
          <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 text-sm font-medium">Login</a>
          <a href="{{ route('register') }}" class="bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">Register</a>
        </div>
        @endauth
      </div>
    </div>
  </header>

  @push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.notif-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          var notifId = this.dataset.notifId;
          var href = this.getAttribute('href');
          fetch('/notifications/' + notifId + '/mark-as-read', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Accept': 'application/json'
            }
          }).then(function() {
            window.location.href = href;
          });
        });
      });
    });
  </script>
  @endpush
</body>
</html>