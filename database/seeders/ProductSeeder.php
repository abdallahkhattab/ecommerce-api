<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if brands and categories exist
        if (Brand::count() === 0) {
            $this->command->info('Seeding brands...');
            Brand::factory()->count(5)->create(); // Seed 5 brands if none exist
        }

        if (Category::count() === 0) {
            $this->command->info('Seeding categories...');
            Category::factory()->count(10)->create(); // Seed 10 categories if none exist
        }

        // Seed 50 fake products
        $this->command->info('Seeding products...');
        Product::factory()->count(50)->create();
    }
}
