<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@shopHub.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'order' => 1],
            ['name' => 'Clothing', 'order' => 2],
            ['name' => 'Books', 'order' => 3],
            ['name' => 'Home & Garden', 'order' => 4],
            ['name' => 'Sports', 'order' => 5],
            ['name' => 'Beauty', 'order' => 6],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'price' => 2500,
                'discounted_price' => 2000,
                'description' => 'High-quality wireless headphones with noise cancellation and long battery life.',
                'category_id' => 1,
                'stock' => 50,
                'photopath' => '1749962436.jpg'
            ],
            [
                'name' => 'Smartphone Case',
                'price' => 800,
                'discounted_price' => 600,
                'description' => 'Durable smartphone case with shock absorption and stylish design.',
                'category_id' => 1,
                'stock' => 100,
                'photopath' => '1749962508.jpg'
            ],
            [
                'name' => 'Cotton T-Shirt',
                'price' => 1200,
                'description' => 'Comfortable cotton t-shirt available in multiple colors and sizes.',
                'category_id' => 2,
                'stock' => 75,
                'photopath' => '1749964036.webp'
            ],
            [
                'name' => 'Denim Jeans',
                'price' => 2500,
                'discounted_price' => 2000,
                'description' => 'Classic denim jeans with perfect fit and modern styling.',
                'category_id' => 2,
                'stock' => 40,
                'photopath' => '1750168885.webp'
            ],
            [
                'name' => 'Programming Book',
                'price' => 1500,
                'description' => 'Comprehensive guide to modern programming techniques and best practices.',
                'category_id' => 3,
                'stock' => 25,
                'photopath' => '1750168937.png'
            ],
            [
                'name' => 'Garden Plant Pot',
                'price' => 800,
                'discounted_price' => 600,
                'description' => 'Beautiful ceramic plant pot perfect for indoor and outdoor plants.',
                'category_id' => 4,
                'stock' => 60,
                'photopath' => '1749962436.jpg'
            ],
            [
                'name' => 'Yoga Mat',
                'price' => 1200,
                'description' => 'Non-slip yoga mat with comfortable padding for all types of exercises.',
                'category_id' => 5,
                'stock' => 30,
                'photopath' => '1749962508.jpg'
            ],
            [
                'name' => 'Facial Cream',
                'price' => 1800,
                'discounted_price' => 1500,
                'description' => 'Moisturizing facial cream with natural ingredients for all skin types.',
                'category_id' => 6,
                'stock' => 45,
                'photopath' => '1749964036.webp'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
