# 🗄️ Database Documentation

## 📋 Overview

Database untuk Coffee Shop E-Commerce menggunakan MySQL dengan struktur yang dirancang untuk mendukung fitur-fitur toko kopi online lengkap.

## 🗂️ File Database

### 1. `store_database.sql`
File SQL dump lengkap yang berisi:
- Struktur database (CREATE TABLE)
- Sample data untuk testing
- Foreign key constraints
- Indexes untuk optimasi

## 🚀 Cara Menggunakan Database

### Import Database

#### Menggunakan Command Line
```bash
# Import database
mysql -u username -p < database/store_database.sql

# Atau jika sudah ada database
mysql -u username -p store < database/store_database.sql
```

#### Menggunakan phpMyAdmin
1. Buka phpMyAdmin
2. Buat database baru bernama `store`
3. Pilih database `store`
4. Klik tab "Import"
5. Upload file `store_database.sql`
6. Klik "Go" untuk import

#### Menggunakan Laravel Artisan
```bash
# Jalankan migration
php artisan migrate

# Jalankan seeder
php artisan db:seed
```

## 📊 Struktur Database

### Tables

| Table | Description | Records |
|-------|-------------|---------|
| `users` | Admin dan customer accounts | 1 (admin) |
| `categories` | Kategori produk kopi | 5 |
| `products` | Data produk kopi dan alat seduh | 15 |
| `customers` | Data customer | 1 |
| `orders` | Data pesanan | 1 |
| `order_items` | Detail item pesanan | 2 |
| `settings` | Konfigurasi aplikasi | 4 |

### Sample Data

#### Admin User
- **Email**: `admin@admin.com`
- **Password**: `password`
- **Role**: `admin`

#### Categories
1. Kopi Siap Minum
2. Biji Kopi
3. Bubuk Kopi
4. Alat Seduh
5. Paket Bundling

#### Products
- Espresso Single Shot (Rp 15.000, stok: 50)
- Cappuccino (Rp 25.000, stok: 40)
- Latte (Rp 22.000, stok: 45)
- Americano (Rp 18.000, stok: 60)
- Biji Kopi Arabika Aceh (Rp 85.000, stok: 25)
- Biji Kopi Robusta Lampung (Rp 75.000, stok: 30)
- Bubuk Kopi Toraja (Rp 65.000, stok: 35)
- Bubuk Kopi Bali (Rp 55.000, stok: 40)
- French Press (Rp 150.000, stok: 15)
- V60 Dripper (Rp 85.000, stok: 20)
- Coffee Grinder Manual (Rp 120.000, stok: 12)
- Paket Starter Kit (Rp 280.000, stok: 8)
- Paket Gift Set (Rp 180.000, stok: 10)
- Mocha (Rp 28.000, stok: 35)
- Macchiato (Rp 20.000, stok: 30)

## 🔧 Konfigurasi Environment

Pastikan file `.env` memiliki konfigurasi database yang benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=store
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 🔄 Backup dan Restore

### Backup Database
```bash
# Backup struktur dan data
mysqldump -u username -p store > backup_store_$(date +%Y%m%d_%H%M%S).sql

# Backup struktur saja
mysqldump -u username -p --no-data store > store_structure.sql

# Backup data saja
mysqldump -u username -p --no-create-info store > store_data.sql
```

### Restore Database
```bash
# Restore dari backup
mysql -u username -p store < backup_store_20240120_120000.sql
```

## 📈 Optimasi Database

### Indexes
Database sudah dioptimasi dengan indexes pada:
- Foreign key columns
- Email columns (unique)
- Created_at columns untuk sorting

### Recommendations
1. **Regular Backups**: Backup database secara berkala
2. **Monitor Performance**: Gunakan tools seperti MySQL Workbench
3. **Update Statistics**: Jalankan `ANALYZE TABLE` secara berkala
4. **Optimize Tables**: Jalankan `OPTIMIZE TABLE` setelah operasi bulk

## 🔒 Security Considerations

### Data Protection
- Password di-hash menggunakan bcrypt
- Email addresses di-validasi
- Input sanitization di Laravel

### Access Control
- Gunakan user database dengan minimal privileges
- Batasi akses database hanya dari aplikasi
- Enkripsi koneksi database jika diperlukan

## 🐛 Troubleshooting

### Common Issues

#### 1. Foreign Key Constraints
```sql
-- Disable foreign key checks temporarily
SET FOREIGN_KEY_CHECKS = 0;
-- Your operations here
SET FOREIGN_KEY_CHECKS = 1;
```

#### 2. Character Set Issues
```sql
-- Set proper character set
ALTER DATABASE store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 3. Permission Issues
```sql
-- Grant permissions to user
GRANT ALL PRIVILEGES ON store.* TO 'username'@'localhost';
FLUSH PRIVILEGES;
```

## 📝 Notes

- Database menggunakan UTF8MB4 untuk support emoji
- Timestamps menggunakan Laravel's default format
- Auto-increment values di-reset setelah sample data
- Foreign key constraints dengan CASCADE delete

## 🔗 Related Files

- `database/migrations/` - Laravel migration files
- `database/seeders/` - Laravel seeder files
- `.env` - Environment configuration
- `config/database.php` - Database configuration 