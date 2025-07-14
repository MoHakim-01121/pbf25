<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>Contact Us - KopiKita</title>
    <!-- Leaflet CSS for map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
</head>
<body class="bg-gray-50">
    <x-app-layout>
        <!-- Hero Section -->
        <section class="relative h-[400px] overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                     alt="Coffee Shop" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/70"></div>
            </div>
            <div class="relative h-full max-w-7xl mx-auto px-6 flex flex-col justify-center text-center">
                <span class="text-lg font-medium text-indigo-400 mb-4" data-aos="fade-up">Hubungi Kami</span>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" data-aos="fade-up" data-aos-delay="100">
                    Mari Ngopi Bersama
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Tim kami siap membantu Anda menemukan kopi terbaik untuk selera Anda
                </p>
            </div>
        </section>

        <!-- Contact Information Cards -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up">
                        <span class="inline-block p-4 bg-indigo-100 text-indigo-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Email Kami</h3>
                        <p class="mt-2 text-gray-600">Kami akan membalas dalam 24 jam</p>
                        <a href="mailto:hello@kopikita.com" class="mt-4 inline-block text-indigo-600 hover:text-indigo-700">
                            hello@kopikita.com
                        </a>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                        <span class="inline-block p-4 bg-indigo-100 text-indigo-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Kunjungi Kami</h3>
                        <p class="mt-2 text-gray-600">Coffee Shop buka setiap hari</p>
                        <p class="mt-4 text-indigo-600">
                            Jl. Kopi Arabika No. 123<br>
                            Jakarta Selatan, 12345
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                        <span class="inline-block p-4 bg-indigo-100 text-indigo-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </span>
                        <h3 class="mt-6 text-xl font-semibold text-gray-900">Telepon Kami</h3>
                        <p class="mt-2 text-gray-600">Setiap hari, 08:00 - 22:00</p>
                        <a href="tel:+6281234567890" class="mt-4 inline-block text-indigo-600 hover:text-indigo-700">
                            +62 812-3456-7890
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form & Map Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg" data-aos="fade-right">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <input type="tel" name="phone" id="phone"
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                                <textarea name="message" id="message" rows="4" required
                                    class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-600 focus:border-transparent"></textarea>
                            </div>
                            <button type="submit"
                                class="w-full px-6 py-3 text-base font-medium rounded-lg text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>

                    <!-- Map -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg" data-aos="fade-left">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Lokasi Kami</h2>
                        <div id="map" class="h-[400px] rounded-lg"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Pertanyaan yang Sering Diajukan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <div class="bg-gray-50 p-6 rounded-xl" data-aos="fade-up">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Apakah bisa pesan kopi online?</h3>
                        <p class="text-gray-600">Ya, Anda bisa memesan biji kopi atau kopi bubuk melalui website kami. Pengiriman dapat dilakukan ke seluruh Indonesia.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Apakah ada kelas brewing?</h3>
                        <p class="text-gray-600">Ya, kami mengadakan kelas brewing coffee setiap akhir pekan. Tersedia untuk pemula hingga tingkat lanjut.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Bagaimana dengan fresh roasted beans?</h3>
                        <p class="text-gray-600">Kami melakukan roasting setiap hari untuk memastikan Anda mendapatkan biji kopi dengan tingkat kesegaran terbaik.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Apakah tersedia ruang meeting?</h3>
                        <p class="text-gray-600">Ya, kami menyediakan ruang meeting yang nyaman dengan kapasitas 4-20 orang. Reservasi dapat dilakukan minimal H-1.</p>
                    </div>
                </div>
            </div>
        </section>

        <x-footer />

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script>
            // Initialize map
            document.addEventListener('DOMContentLoaded', function() {
                const map = L.map('map').setView([-6.2088, 106.8456], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add marker
                const marker = L.marker([-6.2088, 106.8456]).addTo(map);
                marker.bindPopup("<b>KopiKita</b><br>Coffee Shop & Roastery").openPopup();
            });

            // Form submission animation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const button = form.querySelector('button[type="submit"]');
                button.innerHTML = '<span class="inline-block animate-spin mr-2">↻</span> Mengirim...';
                
                // Simulate form submission (replace with actual form submission)
                setTimeout(() => {
                    button.innerHTML = '✓ Terkirim!';
                    button.classList.add('bg-green-600');
                    setTimeout(() => {
                        button.innerHTML = 'Kirim Pesan';
                        button.classList.remove('bg-green-600');
                        form.reset();
                    }, 2000);
                }, 1500);
            });
        </script>
    </x-app-layout>
</body>
</html>
