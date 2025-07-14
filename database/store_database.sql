 -- Coffee Shop E-Commerce Database Dump
-- Created: 2024-01-20
-- Description: Database structure and sample data for Coffee Shop E-Commerce Laravel Application

-- Drop database if exists and create new one
DROP DATABASE IF EXISTS `store`;
CREATE DATABASE `store` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `store`;

-- Users table
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories table
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Products table
CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Customers table
CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Orders table
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `shipping_method` varchar(255) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Order Items table
CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings table
CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data

-- Admin user
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '2024-01-20 00:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Categories
INSERT INTO `categories` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kopi Siap Minum', 'Berbagai jenis kopi yang siap untuk diminum, seperti espresso, americano, latte, dan cappuccino.', 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(2, 'Biji Kopi', 'Koleksi biji kopi pilihan dari berbagai daerah, tersedia dalam bentuk green bean atau roasted.', 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(3, 'Bubuk Kopi', 'Kopi yang sudah digiling dan siap untuk diseduh, tersedia dalam berbagai varian dan tingkat sangrai.', 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(4, 'Alat Seduh', 'Peralatan untuk menyeduh kopi seperti dripper, french press, grinder, dan berbagai aksesoris brewing.', 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(5, 'Paket Bundling', 'Paket spesial yang berisi kombinasi produk kopi dan alat seduh dengan harga menarik.', 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Products
INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `image`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Espresso Single Shot', 'Espresso murni dengan rasa yang kuat dan kental', 15000.00, 50, 1, 'products/espresso.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(2, 'Cappuccino', 'Kombinasi espresso, steamed milk, dan foam susu', 25000.00, 40, 1, 'products/cappuccino.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(3, 'Latte', 'Espresso dengan steamed milk yang lembut', 22000.00, 45, 1, 'products/latte.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(4, 'Americano', 'Espresso dengan air panas', 18000.00, 60, 1, 'products/americano.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(5, 'Biji Kopi Arabika Aceh', 'Biji kopi arabika premium dari dataran tinggi Aceh', 85000.00, 25, 2, 'products/arabika-aceh.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(6, 'Biji Kopi Robusta Lampung', 'Biji kopi robusta dengan karakteristik yang kuat', 75000.00, 30, 2, 'products/robusta-lampung.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(7, 'Bubuk Kopi Toraja', 'Bubuk kopi Toraja dengan tingkat sangrai medium', 65000.00, 35, 3, 'products/toraja-powder.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(8, 'Bubuk Kopi Bali', 'Bubuk kopi Bali dengan aroma yang khas', 55000.00, 40, 3, 'products/bali-powder.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(9, 'French Press', 'Alat seduh kopi manual dengan hasil yang konsisten', 150000.00, 15, 4, 'products/french-press.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(10, 'V60 Dripper', 'Pour over dripper untuk hasil kopi yang bersih', 85000.00, 20, 4, 'products/v60-dripper.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(11, 'Coffee Grinder Manual', 'Penggiling kopi manual untuk hasil yang optimal', 120000.00, 12, 4, 'products/grinder.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(12, 'Paket Starter Kit', 'Paket lengkap untuk pemula: French Press + Biji Kopi + Grinder', 280000.00, 8, 5, 'products/starter-kit.jpg', 1, 1, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(13, 'Paket Gift Set', 'Paket hadiah: V60 + Bubuk Kopi Premium + Mug', 180000.00, 10, 5, 'products/gift-set.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(14, 'Mocha', 'Kombinasi espresso, cokelat, dan steamed milk', 28000.00, 35, 1, 'products/mocha.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(15, 'Macchiato', 'Espresso dengan sedikit foam susu', 20000.00, 30, 1, 'products/macchiato.jpg', 1, 0, '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Sample customer
INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', '+1234567890', '123 Main St, City, Country', '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Sample order
INSERT INTO `orders` (`id`, `user_id`, `customer_id`, `total_amount`, `status`, `payment_method`, `shipping_address`, `notes`, `order_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40000.00, 'completed', 'bank_transfer', 'Jl. Sudirman No. 123, Jakarta', 'Pesanan kopi untuk meeting', '2024-01-20 00:00:00', '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Sample order items
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 15000.00, '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(2, 1, 2, 1, 25000.00, '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Sample settings
INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'store_name', 'Coffee Shop Store', '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(2, 'store_description', 'Toko kopi premium dengan berbagai varian kopi dan alat seduh berkualitas', '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(3, 'contact_email', 'contact@coffeeshop.com', '2024-01-20 00:00:00', '2024-01-20 00:00:00'),
(4, 'contact_phone', '+6281234567890', '2024-01-20 00:00:00', '2024-01-20 00:00:00');

-- Reset auto increment values
ALTER TABLE `users` AUTO_INCREMENT = 2;
ALTER TABLE `categories` AUTO_INCREMENT = 6;
ALTER TABLE `products` AUTO_INCREMENT = 16;
ALTER TABLE `customers` AUTO_INCREMENT = 2;
ALTER TABLE `orders` AUTO_INCREMENT = 2;
ALTER TABLE `order_items` AUTO_INCREMENT = 3;
ALTER TABLE `settings` AUTO_INCREMENT = 5;