<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan kategori produk kopi
        Category::create([
            'name' => 'Kopi Siap Minum',
            'description' => 'Berbagai jenis kopi yang siap untuk diminum, seperti espresso, americano, latte, dan cappuccino.'
        ]);

        Category::create([
            'name' => 'Biji Kopi',
            'description' => 'Koleksi biji kopi pilihan dari berbagai daerah, tersedia dalam bentuk green bean atau roasted.'
        ]);

        Category::create([
            'name' => 'Bubuk Kopi',
            'description' => 'Kopi yang sudah digiling dan siap untuk diseduh, tersedia dalam berbagai varian dan tingkat sangrai.'
        ]);

        Category::create([
            'name' => 'Alat Seduh',
            'description' => 'Peralatan untuk menyeduh kopi seperti dripper, french press, grinder, dan berbagai aksesoris brewing.'
        ]);

        Category::create([
            'name' => 'Paket Bundling',
            'description' => 'Paket spesial yang berisi kombinasi produk kopi dan alat seduh dengan harga menarik.'
        ]);
    }
}
