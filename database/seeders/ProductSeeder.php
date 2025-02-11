<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'brand_id' => 1,
                'category_id' => 1,
                'name' => 'Laptop',
                'slug' => 'laptop',
                'description' => 'A high-performance laptop',
                'price' => 999.99,
                'discount' => 0.00,
                'image' => 'images/products/laptop.jpg',
                'quantity' => 50,
            ],
            [
                'brand_id' => 2,
                'category_id' => 2,
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'description' => 'A modern smartphone',
                'price' => 499.99,
                'discount' => 50.00,
                'image' => 'images/products/smartphone.jpg',
                'quantity' => 100,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
