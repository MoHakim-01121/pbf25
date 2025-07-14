<?php
$menuItems = [
    [
        'route' => 'dashboard',
        'path' => 'dashboard',
        'exact' => true,
        'label' => 'Dashboard',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />'
    ],
    [
        'route' => 'dashboard.products.index',
        'path' => 'dashboard/products',
        'exact' => false,
        'label' => 'Produk',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />',
        'badge' => isset($lowStockCount) && $lowStockCount > 0 ? $lowStockCount : null,
        'badge_color' => 'red'
    ],
    [
        'route' => 'dashboard.transactions.index',
        'path' => 'dashboard/transactions',
        'exact' => false,
        'label' => 'Transaksi',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />',
        'badge' => isset($pendingOrderCount) && $pendingOrderCount > 0 ? $pendingOrderCount : null,
        'badge_color' => 'yellow'
    ],
    [
        'route' => 'dashboard.customers.index',
        'path' => 'dashboard/customers',
        'exact' => false,
        'label' => 'Pelanggan',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />'
    ],
    [
        'route' => 'dashboard.reports.index',
        'path' => 'dashboard/reports',
        'exact' => false,
        'label' => 'Laporan',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />'
    ]
];

$currentPath = request()->path();
?>

<aside x-data="{ isCollapsed: false }" 
       :class="isCollapsed ? 'w-[68px]' : 'w-64'"
       class="flex flex-col min-h-screen bg-white border-r transition-all duration-300 ease-in-out">
    <!-- Header -->
    <div class="flex items-center p-5 h-16">
        <div class="flex items-center gap-3 cursor-pointer" 
             :class="{ 'justify-center': isCollapsed }"
             @click="isCollapsed = false">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
            </div>
            <h1 x-show="!isCollapsed" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-x-4"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-4"
                class="text-lg font-semibold text-gray-900">KopiKita</h1>
        </div>
        <button x-show="!isCollapsed"
                @click="isCollapsed = true"
                class="ml-auto p-2 rounded-lg hover:bg-gray-100 transition-all duration-300 ease-in-out">
            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @foreach($menuItems as $item)
            @php
                $isActive = $item['exact'] 
                    ? $currentPath === $item['path']
                    : str_starts_with($currentPath, $item['path']) && $currentPath !== 'dashboard';
            @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 relative
                      {{ $isActive 
                          ? 'bg-gray-100 text-gray-900' 
                          : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                @if($isActive)
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-1 h-8 bg-gray-900 rounded-r-full"></div>
                @endif
                <div class="flex-shrink-0 w-6 h-6">
                    <svg class="transition-colors duration-200 {{ $isActive ? 'text-gray-900' : 'text-gray-400' }}" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $item['icon'] !!}
                    </svg>
                </div>
                <span x-show="!isCollapsed" 
                      x-transition:enter="transition ease-out duration-300"
                      x-transition:enter-start="opacity-0 transform -translate-x-4"
                      x-transition:enter-end="opacity-100 transform translate-x-0"
                      x-transition:leave="transition ease-in duration-300"
                      x-transition:leave-start="opacity-100 transform translate-x-0"
                      x-transition:leave-end="opacity-0 transform -translate-x-4"
                      class="flex-1 whitespace-nowrap">{{ $item['label'] }}</span>
                @if(isset($item['badge']))
                    <span x-show="!isCollapsed" 
                          x-transition:enter="transition ease-out duration-300"
                          x-transition:enter-start="opacity-0 scale-95"
                          x-transition:enter-end="opacity-100 scale-100"
                          x-transition:leave="transition ease-in duration-300"
                          x-transition:leave-start="opacity-100 scale-100"
                          x-transition:leave-end="opacity-0 scale-95"
                          class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                 bg-{{ $item['badge_color'] }}-100 text-{{ $item['badge_color'] }}-800">
                        {{ $item['badge'] }}
                    </span>
                @endif
            </a>
        @endforeach
    </nav>
</aside>

@push('scripts')
<script src="//unpkg.com/alpinejs" defer></script>
@endpush