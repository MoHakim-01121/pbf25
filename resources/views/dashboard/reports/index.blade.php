@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Analytics</h1>
            <p class="text-gray-600">Insight mendalam tentang performa bisnis Anda</p>
        </div>
        <div class="flex items-center gap-4">
            <div>
                <select id="period" name="period" 
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        onchange="window.location.href = '{{ route('dashboard.reports.index') }}?period=' + this.value">
                    <option value="this_month" {{ $period == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="last_month" {{ $period == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                    <option value="this_year" {{ $period == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                    <option value="last_year" {{ $period == 'last_year' ? 'selected' : '' }}>Tahun Lalu</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Growth Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pertumbuhan Pendapatan</p>
                    <p class="mt-1 text-3xl font-semibold {{ $growthMetrics['revenue_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($growthMetrics['revenue_growth'], 1) }}%
                    </p>
                </div>
                <div class="{{ $growthMetrics['revenue_growth'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} p-3 rounded-full">
                    <svg class="w-6 h-6 {{ $growthMetrics['revenue_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $growthMetrics['revenue_growth'] >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                    </svg>
                </div>
            </div>
            <p class="mt-1 text-sm text-gray-500">vs periode sebelumnya</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pertumbuhan Pesanan</p>
                    <p class="mt-1 text-3xl font-semibold {{ $growthMetrics['orders_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($growthMetrics['orders_growth'], 1) }}%
                    </p>
                </div>
                <div class="{{ $growthMetrics['orders_growth'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} p-3 rounded-full">
                    <svg class="w-6 h-6 {{ $growthMetrics['orders_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $growthMetrics['orders_growth'] >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                    </svg>
                </div>
            </div>
            <p class="mt-1 text-sm text-gray-500">vs periode sebelumnya</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pertumbuhan Pelanggan</p>
                    <p class="mt-1 text-3xl font-semibold {{ $growthMetrics['customers_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($growthMetrics['customers_growth'], 1) }}%
                    </p>
                </div>
                <div class="{{ $growthMetrics['customers_growth'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} p-3 rounded-full">
                    <svg class="w-6 h-6 {{ $growthMetrics['customers_growth'] >= 0 ? 'text-green-600' : 'text-red-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $growthMetrics['customers_growth'] >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}" />
                    </svg>
                </div>
            </div>
            <p class="mt-1 text-sm text-gray-500">vs periode sebelumnya</p>
        </div>
    </div>

    <!-- Customer Retention -->
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Analisis Retensi Pelanggan</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <p class="text-sm text-gray-500">Total Pelanggan</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($retentionAnalysis['total_customers']) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelanggan Berulang</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($retentionAnalysis['returning_customers']) }}</p>
                    <p class="mt-1 text-sm text-green-600">
                        {{ $retentionAnalysis['total_customers'] > 0 
                            ? number_format(($retentionAnalysis['returning_customers'] / $retentionAnalysis['total_customers']) * 100, 1) 
                            : '0' }}% dari total
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Rata-rata Pembelian per Pelanggan</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($retentionAnalysis['average_purchases_per_customer'], 1) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Rata-rata Masa Aktif Pelanggan</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($retentionAnalysis['average_customer_lifetime_days']) }}</p>
                    <p class="mt-1 text-sm text-gray-500">hari</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Distribution -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- By Day of Week -->
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Distribusi Penjualan per Hari</h3>
            </div>
            <div class="p-6">
                <canvas id="salesByDayChart" height="300"></canvas>
            </div>
        </div>

        <!-- By Hour -->
        <div class="bg-white rounded-lg shadow-sm border">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Distribusi Penjualan per Jam</h3>
            </div>
            <div class="p-6">
                <canvas id="salesByHourChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Product Analytics -->
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Analisis Produk</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Terjual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Rata-rata</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit per Pelanggan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($productAnalytics as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($product->units_sold) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($product->revenue, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format($product->average_selling_price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($product->units_per_customer, 1) }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Tidak ada data produk untuk periode ini
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(session('error'))
<div class="fixed bottom-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
    <p class="text-sm">{{ session('error') }}</p>
</div>
@endif

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales by Day of Week Chart
    const dayCtx = document.getElementById('salesByDayChart').getContext('2d');
    const dayData = @json($salesDistribution['by_day_of_week']);
    
    if (dayData && dayData.length > 0) {
        new Chart(dayCtx, {
            type: 'bar',
            data: {
                labels: dayData.map(d => d.day_name),
                datasets: [{
                    label: 'Pendapatan',
                    data: dayData.map(d => d.total_revenue),
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgb(79, 70, 229)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });
    } else {
        dayCtx.canvas.style.display = 'none';
        dayCtx.canvas.parentNode.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada data untuk periode ini</p>';
    }

    // Sales by Hour Chart
    const hourCtx = document.getElementById('salesByHourChart').getContext('2d');
    const hourData = @json($salesDistribution['by_hour']);
    
    if (hourData && hourData.length > 0) {
        new Chart(hourCtx, {
            type: 'line',
            data: {
                labels: hourData.map(h => h.hour_of_day + ':00'),
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: hourData.map(h => h.order_count),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    } else {
        hourCtx.canvas.style.display = 'none';
        hourCtx.canvas.parentNode.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada data untuk periode ini</p>';
    }
});
</script>
@endpush
@endsection 