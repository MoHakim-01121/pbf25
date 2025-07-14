<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - KopiKita</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900">

    <x-app-layout>
        <!-- Hero Section with Parallax -->
        <section class="relative h-[600px] overflow-hidden">
            <!-- Background Image with Parallax -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1511081692775-05d0f180a065?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                     alt="Coffee Roastery" 
                     class="w-full h-full object-cover"
                     style="transform: translateY(var(--parallax-offset, 0));">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>

            <!-- Content -->
            <div class="relative h-full max-w-7xl mx-auto px-6 flex flex-col justify-center text-white">
                <span class="text-lg font-medium text-indigo-400 mb-4">Tentang KopiKita</span>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6 max-w-3xl">
                    Menyajikan Kopi Terbaik untuk Anda
                </h1>
                <p class="text-xl max-w-2xl leading-relaxed text-gray-200">
                    Sejak 2010, kami telah berkomitmen untuk menghadirkan pengalaman kopi berkualitas tinggi melalui pemilihan biji terbaik dan proses roasting yang sempurna.
                </p>
            </div>
        </section>

        <!-- Stats Section with Animation -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center" data-aos="fade-up" data-aos-delay="0">
                        <span class="block text-4xl font-bold text-indigo-600 mb-2 counter" data-target="13">0</span>
                        <span class="text-gray-600">Tahun Pengalaman</span>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                        <span class="block text-4xl font-bold text-indigo-600 mb-2 counter" data-target="50000">0</span>
                        <span class="text-gray-600">Cangkir Kopi</span>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                        <span class="block text-4xl font-bold text-indigo-600 mb-2 counter" data-target="15">0</span>
                        <span class="text-gray-600">Varian Kopi</span>
                    </div>
                    <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                        <span class="block text-4xl font-bold text-indigo-600 mb-2 counter" data-target="5">0</span>
                        <span class="text-gray-600">Cabang</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Section with Fade Animation -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12 px-6">
                <div class="md:w-1/2" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80" 
                         alt="Coffee Roasting" 
                         class="rounded-2xl shadow-xl w-full object-cover transform hover:scale-105 transition-transform duration-500">
                </div>
                <div class="md:w-1/2" data-aos="fade-left">
                    <span class="text-indigo-600 font-medium mb-2 block">Cerita Kami</span>
                    <h2 class="text-4xl font-bold mb-6 text-gray-900">Mengapa Kami Ada</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        KopiKita lahir dari passion untuk menghadirkan pengalaman kopi berkualitas tinggi kepada pecinta kopi Indonesia. Kami percaya bahwa setiap cangkir kopi memiliki ceritanya sendiri, dan setiap pelanggan berhak menikmati kopi terbaik.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Dengan menggabungkan keahlian roasting, pemilihan biji kopi terbaik, dan layanan yang personal, kami menciptakan pengalaman menikmati kopi yang melampaui ekspektasi — kami membantu Anda menemukan cita rasa kopi favorit Anda.
                    </p>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100" 
                                 alt="CEO" 
                                 class="w-12 h-12 rounded-full">
                            <div class="ml-3">
                                <p class="text-gray-900 font-medium">Budi Santoso</p>
                                <p class="text-gray-500 text-sm">Founder & Head Roaster</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-indigo-600 font-medium mb-2 block">Nilai-Nilai Kami</span>
                    <h2 class="text-4xl font-bold text-gray-900">Yang Kami Yakini</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-colors duration-300" data-aos="fade-up" data-aos-delay="0">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Kualitas Tanpa Kompromi</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Setiap biji kopi yang kami pilih melewati proses seleksi ketat dan roasting yang presisi untuk menghasilkan cita rasa terbaik.
                        </p>
                    </div>
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-colors duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Kepuasan Pelanggan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kami berkomitmen memberikan pengalaman kopi terbaik dengan layanan yang ramah dan pengetahuan yang mendalam tentang kopi.
                        </p>
                    </div>
                    <div class="p-8 rounded-2xl bg-gray-50 hover:bg-gray-100 transition-colors duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Keberlanjutan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kami mendukung petani kopi lokal dan praktik pertanian berkelanjutan untuk masa depan kopi Indonesia yang lebih baik.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-indigo-600 font-medium mb-2 block">Tim Kami</span>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Bertemu dengan Para Ahli Kopi</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Tim berpengalaman kami siap membantu Anda menemukan kopi yang sesuai dengan selera Anda.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="0">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=500&h=500&q=80" 
                             alt="Budi Santoso" 
                             class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Budi Santoso</h3>
                            <p class="text-indigo-600 mb-4">Founder & Head Roaster</p>
                            <p class="text-gray-600 mb-4">
                                Memimpin tim dengan pengalaman 15 tahun dalam industri kopi dan sertifikasi Q-Grader.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=500&h=500&q=80" 
                             alt="Sarah Wijaya" 
                             class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Sarah Wijaya</h3>
                            <p class="text-indigo-600 mb-4">Head Barista</p>
                            <p class="text-gray-600 mb-4">
                                Ahli dalam teknik brewing dan latte art dengan berbagai penghargaan barista nasional.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=500&h=500&q=80" 
                             alt="Rudi Hartono" 
                             class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Rudi Hartono</h3>
                            <p class="text-indigo-600 mb-4">Green Bean Buyer</p>
                            <p class="text-gray-600 mb-4">
                                Berkeliling Indonesia mencari biji kopi terbaik dan membangun hubungan dengan petani lokal.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- VISI MISI SECTION -->
        <section class="bg-gray-100 py-20">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold mb-12 text-gray-900">Visi & Misi Kami</h2>
                <div class="grid gap-10 md:grid-cols-2">
                    <div class="bg-white p-10 rounded-2xl shadow hover:shadow-lg transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4 text-indigo-600">Visi</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Menjadi destinasi kopi terkemuka yang menginspirasi dan mengedukasi pecinta kopi di Indonesia melalui kualitas dan inovasi.
                        </p>
                    </div>
                    <div class="bg-white p-10 rounded-2xl shadow hover:shadow-lg transition duration-300">
                        <h3 class="text-2xl font-semibold mb-4 text-indigo-600">Misi</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Menghadirkan pengalaman kopi berkualitas tinggi, mendukung petani lokal, dan membangun komunitas pecinta kopi yang berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-indigo-600 font-medium mb-2 block">Testimoni</span>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Apa Kata Pelanggan Kami</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                        Dengarkan langsung dari pelanggan kami tentang pengalaman mereka berbelanja di YourStore.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="0">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" alt="Sarah">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">Sarah K.</h4>
                                <p class="text-gray-600">Interior Designer</p>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            "Kualitas furnitur dari YourStore luar biasa. Saya sangat senang dengan layanan pelanggan mereka yang responsif dan profesional."
                        </p>
                        <div class="mt-4 flex text-yellow-400">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" alt="John">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">John M.</h4>
                                <p class="text-gray-600">Arsitek</p>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            "Desain yang modern dan fungsional. YourStore memahami kebutuhan profesional dalam mencari furnitur berkualitas."
                        </p>
                        <div class="mt-4 flex text-yellow-400">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-2xl" data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=100&h=100&q=80" alt="Lisa">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">Lisa R.</h4>
                                <p class="text-gray-600">Pengusaha</p>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            "Pengiriman cepat dan tepat waktu. Produk persis seperti yang digambarkan. Sangat merekomendasikan YourStore!"
                        </p>
                        <div class="mt-4 flex text-yellow-400">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative py-24 overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                     alt="Modern living room" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/70"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">Mulai Perjalanan Anda Bersama Kami</h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    Temukan koleksi furnitur berkualitas kami dan ubah ruang Anda menjadi tempat yang nyaman dan indah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 text-base font-medium rounded-lg bg-white text-gray-900 hover:bg-gray-100 transition-colors shadow-lg hover:shadow-xl">
                        Lihat Koleksi
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                    <a href="#" class="inline-flex items-center px-6 py-3 text-base font-medium rounded-lg bg-transparent text-white border-2 border-white hover:bg-white hover:text-gray-900 transition-colors shadow-lg hover:shadow-xl">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

        <x-footer />

        @push('scripts')
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true
            });

            // Counter animation
            document.addEventListener('DOMContentLoaded', () => {
                const counters = document.querySelectorAll('.counter');
                const speed = 200;

                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-target');
                    const increment = target / speed;

                    const updateCount = () => {
                        const count = +counter.innerText;
                        if (count < target) {
                            counter.innerText = Math.ceil(count + increment);
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    updateCount();
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('[style*="--parallax-offset"]');
                
                parallaxElements.forEach(element => {
                    element.style.setProperty('--parallax-offset', scrolled * 0.5 + 'px');
                });
            });
        </script>
        @endpush
    </x-app-layout>

</body>
</html>
