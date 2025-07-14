@extends('layouts.admin') 
{{-- Menggunakan layout admin sebagai kerangka utama halaman ini --}}

@section('content')
<div class="space-y-6">
    {{-- Bagian Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600">Ringkasan aktivitas dan statistik toko</p>
        </div>
    </div>

    {{-- Kartu Statistik Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        {{-- Total Produk --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Produk</p>
                    {{-- Menampilkan jumlah total produk dengan format angka --}}
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_products']) }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-lg">
                    {{-- Ikon produk --}}
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Pesanan --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pesanan</p>
                    {{-- Menampilkan jumlah total pesanan --}}
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_orders']) }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-lg">
                    {{-- Ikon pesanan --}}
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Pelanggan --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pelanggan</p>
                    {{-- Menampilkan jumlah total pelanggan --}}
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_customers']) }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-lg">
                    {{-- Ikon pelanggan --}}
                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Pendapatan --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pendapatan</p>
                    {{-- Menampilkan total pendapatan dengan format Rupiah --}}
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-lg">
                    {{-- Ikon pendapatan --}}
                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Pelanggan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pelanggan</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">Pelanggan Baru (30 hari)</p>
                        {{-- Menampilkan jumlah pelanggan baru selama 30 hari terakhir --}}
                        <p class="text-xl font-bold text-gray-900">{{ number_format($customer_stats['new_customers']) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Pelanggan Terverifikasi</p>
                        {{-- Menampilkan jumlah pelanggan yang sudah terverifikasi --}}
                        <p class="text-xl font-bold text-gray-900">{{ number_format($customer_stats['verified_customers']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Pesanan --}}
        <div class="bg-white p-6 rounded-lg shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Status Pesanan</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Pending</p>
                    {{-- Jumlah pesanan yang statusnya pending --}}
                    <p class="text-xl font-bold text-orange-600">{{ number_format($order_stats['pending_orders']) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Diproses</p>
                    {{-- Jumlah pesanan yang sedang diproses --}}
                    <p class="text-xl font-bold text-blue-600">{{ number_format($order_stats['processing_orders']) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Selesai</p>
                    {{-- Jumlah pesanan yang sudah selesai --}}
                    <p class="text-xl font-bold text-green-600">{{ number_format($order_stats['completed_orders']) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Dibatalkan</p>
                    {{-- Jumlah pesanan yang dibatalkan --}}
                    <p class="text-xl font-bold text-red-600">{{ number_format($order_stats['cancelled_orders']) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Pesanan Terbaru --}}
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Header tabel --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Looping untuk menampilkan setiap pesanan --}}
                    @foreach($recent_orders as $order)
                    <tr>
                        {{-- Menampilkan ID pesanan --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{-- Menampilkan nama dan email pelanggan --}}
                            <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                        </td>
                        {{-- Menampilkan total harga pesanan dengan format Rupiah --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{-- Mendefinisikan warna dan teks status --}}
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        {{-- Menampilkan tanggal pesanan dalam format 'd M Y' --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Produk Terlaris --}}
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900">Produk Terlaris</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Header tabel produk --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Looping produk terlaris --}}
                    @foreach($top_products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                            {{-- Jika produk punya gambar, tampilkan --}}
                            @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover" />
                            @else
                            <div class="h-10 w-10 bg-gray-200 rounded"></div>
                            @endif
                            {{-- Nama produk --}}
                            <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                        </td>
                        {{-- Harga produk --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        {{-- Jumlah terjual --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->sold_count }}</td>
                        {{-- Stok produk --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script JavaScript untuk toggle dropdown --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dropdownArrow = document.getElementById('dropdown-arrow');

        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', function () {
                if (dropdownMenu.classList.contains('hidden')) {
                    dropdownMenu.classList.remove('hidden');
                    dropdownArrow.classList.add('rotate-180');
                } else {
                    dropdownMenu.classList.add('hidden');
                    dropdownArrow.classList.remove('rotate-180');
                }
            });
        }
    });
</script>
@endsection
