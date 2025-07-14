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
