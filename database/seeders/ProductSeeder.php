<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $livingRoomId = Category::where('name', 'Living Room')->first()->id;
        $bedroomId = Category::where('name', 'Bedroom')->first()->id;
        $kitchenId = Category::where('name', 'Kitchen')->first()->id;
        $officeId = Category::where('name', 'Office')->first()->id;
        $outdoorId = Category::where('name', 'Outdoor')->first()->id;
        $decorId = Category::where('name', 'Decor')->first()->id;

        $products = [
            [
                'name' => 'Modern Sofa Set',
                'description' => 'Elegant 3-seater sofa with premium fabric upholstery',
                'price' => 8999.99,
                'stock' => 10,
                'category_id' => $livingRoomId,
                'image' => 'products/sofa-set.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Luxury King Bed',
                'description' => 'Premium king-size bed with storage',
                'price' => 12999.99,
                'stock' => 5,
                'category_id' => $bedroomId,
                'image' => 'products/king-bed.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Kitchen Island',
                'description' => 'Modern kitchen island with marble top',
                'price' => 7499.99,
                'stock' => 8,
                'category_id' => $kitchenId,
                'image' => 'products/kitchen-island.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Executive Desk',
                'description' => 'Large executive desk with drawers',
                'price' => 4999.99,
                'stock' => 15,
                'category_id' => $officeId,
                'image' => 'products/executive-desk.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Garden Set',
                'description' => 'Weather-resistant garden furniture set',
                'price' => 6999.99,
                'stock' => 7,
                'category_id' => $outdoorId,
                'image' => 'products/garden-set.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Wall Mirror',
                'description' => 'Decorative wall mirror with golden frame',
                'price' => 1299.99,
                'stock' => 20,
                'category_id' => $decorId,
                'image' => 'products/wall-mirror.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Coffee Table',
                'description' => 'Modern coffee table with storage',
                'price' => 2499.99,
                'stock' => 12,
                'category_id' => $livingRoomId,
                'image' => 'products/coffee-table.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Wardrobe',
                'description' => 'Spacious wardrobe with mirror',
                'price' => 5999.99,
                'stock' => 6,
                'category_id' => $bedroomId,
                'image' => 'products/wardrobe.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Dining Set',
                'description' => '6-seater dining set with chairs',
                'price' => 8499.99,
                'stock' => 4,
                'category_id' => $kitchenId,
                'image' => 'products/dining-set.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair',
                'price' => 1999.99,
                'stock' => 25,
                'category_id' => $officeId,
                'image' => 'products/office-chair.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Patio Umbrella',
                'description' => 'Large patio umbrella with stand',
                'price' => 899.99,
                'stock' => 15,
                'category_id' => $outdoorId,
                'image' => 'products/patio-umbrella.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Table Lamp',
                'description' => 'Modern table lamp with LED',
                'price' => 499.99,
                'stock' => 30,
                'category_id' => $decorId,
                'image' => 'products/table-lamp.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 