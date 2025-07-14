<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# 🛍️ E-Commerce Store - Laravel Application

## 📋 Deskripsi Proyek

E-Commerce Store adalah aplikasi web berbasis Laravel yang menyediakan platform toko online lengkap dengan fitur manajemen produk, keranjang belanja, sistem pemesanan, dan dashboard admin. Aplikasi ini dirancang untuk memudahkan pengelolaan toko online dengan antarmuka yang user-friendly.

## ✨ Fitur Utama

### 🛒 Customer Features
- **Browsing Produk**: Melihat katalog produk dengan filter kategori dan pencarian
- **Keranjang Belanja**: Menambah, mengubah, dan menghapus item dari keranjang
- **Checkout**: Proses pembayaran dengan validasi stok real-time
- **Riwayat Pesanan**: Melihat status dan riwayat pesanan
- **Profil Customer**: Mengelola informasi pribadi dan alamat

### 👨‍💼 Admin Features
- **Dashboard**: Statistik penjualan, produk, dan customer
- **Manajemen Produk**: CRUD produk dengan upload gambar
- **Manajemen Kategori**: Mengelola kategori produk
- **Manajemen Order**: Melihat dan mengupdate status pesanan
- **Laporan Transaksi**: Laporan penjualan dan keuangan
- **Notifikasi**: Notifikasi real-time untuk order baru

### 🔧 Technical Features
- **Real-time Stock Management**: Pengurangan stok otomatis saat pembelian
- **Session-based Cart**: Keranjang belanja menggunakan session
- **Email Notifications**: Notifikasi email untuk admin
- **Responsive Design**: Antarmuka yang responsif dengan Tailwind CSS
- **Database Transactions**: Keamanan data dengan database transactions

## 🏗️ Arsitektur Sistem

### Database Schema
- **Users**: Admin dan customer accounts
- **Products**: Data produk dengan kategori
- **Categories**: Kategori produk
- **Orders**: Data pesanan customer
- **Order Items**: Detail item dalam pesanan
- **Customers**: Data customer
- **Settings**: Konfigurasi aplikasi

### File Structure
```
store/
├── app/
│   ├── Http/Controllers/     # Controller untuk handling request
│   ├── Models/              # Eloquent models
│   ├── Notifications/       # Email notifications
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/              # Blade templates
├── routes/                 # Route definitions
└── public/                # Public assets
```

## 🚀 Instalasi dan Setup

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (untuk asset compilation)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd store
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   - Edit file `.env` dan sesuaikan konfigurasi database
   - Jalankan migration dan seeder:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage Setup**
   ```bash
   php artisan storage:link
   ```

6. **Compile Assets**
   ```bash
   npm run dev
   ```

7. **Jalankan Server**
   ```bash
   php artisan serve
   ```

## 📊 Database Seeding

Aplikasi dilengkapi dengan data sample melalui seeders:
- **AdminUserSeeder**: Membuat user admin default
- **CategorySeeder**: Kategori produk sample
- **ProductSeeder**: Produk sample dengan gambar

### Login Admin Default
- Email: `admin@example.com`
- Password: `password`

## 🔄 Workflow Sistem

### 1. Customer Journey
1. Customer browse produk di halaman shop
2. Menambahkan produk ke keranjang
3. Melakukan checkout dengan mengisi data
4. Sistem validasi stok dan membuat order
5. Stok otomatis berkurang
6. Admin mendapat notifikasi order baru

### 2. Admin Workflow
1. Admin login ke dashboard
2. Melihat order baru di notifikasi
3. Mengupdate status order
4. Mengelola produk dan kategori
5. Melihat laporan penjualan

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 10**: PHP framework
- **MySQL**: Database
- **Eloquent ORM**: Database abstraction
- **Blade**: Template engine

### Frontend
- **Tailwind CSS**: CSS framework
- **Alpine.js**: JavaScript framework
- **Livewire**: Real-time components

### Tools & Libraries
- **Laravel Sanctum**: API authentication
- **Laravel Notifications**: Email notifications
- **Laravel Storage**: File management

## 📱 Fitur Responsive

Aplikasi dirancang responsif dengan:
- Mobile-first approach
- Flexible grid system
- Touch-friendly interface
- Optimized images

## 🔒 Keamanan

- **CSRF Protection**: Laravel built-in CSRF protection
- **Input Validation**: Validasi input di semua form
- **SQL Injection Protection**: Menggunakan Eloquent ORM
- **XSS Protection**: Blade template escaping
- **Authentication**: Laravel authentication system

## 📈 Monitoring & Logging

- **Error Logging**: Laravel logging system
- **Database Transactions**: Rollback jika terjadi error
- **Stock Validation**: Validasi stok sebelum checkout

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production` di `.env`
- [ ] Optimize autoloader: `composer install --optimize-autoloader --no-dev`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache views: `php artisan view:cache`
- [ ] Set proper file permissions
- [ ] Configure web server (Apache/Nginx)

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## 📄 License

Proyek ini dibuat untuk keperluan pembelajaran dan pengembangan aplikasi e-commerce.

## 👥 Tim Pengembang

- **Framework**: Laravel 10
- **Database**: MySQL
- **Frontend**: Tailwind CSS + Alpine.js
- **Version Control**: Git

---

**Note**: Pastikan untuk mengatur environment variables dengan benar sebelum menjalankan aplikasi di production.
>>>>>>> a7f3620 (Update README.md)
