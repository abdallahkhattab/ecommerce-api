<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categories = [
            ['name' => 'Electronics', 'slug'=> 'electronics', 'description' => 'All electronic gadgets'],
            ['name' => 'Clothing','slug'=> 'clothing', 'description' => 'Apparel and fashion items'],
            ['name' => 'Books', 'slug'=> 'books','description' => 'Literature and educational materials'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}
