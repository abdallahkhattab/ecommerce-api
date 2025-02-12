<?php

namespace Database\Factories;

use App\Models\Brand; // Ensure this is correct
use App\Models\Category; // Ensure this is correct
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true); // Generate a random product name (e.g., "Laptop Pro X")

        // Randomly select a brand and category
        $brand = Brand::inRandomOrder()->first(); // Ensure brands exist in the database
        $category = Category::inRandomOrder()->first(); // Ensure categories exist in the database

        return [
            'user_id' => $this->faker->numberBetween(1, 8), // Random user ID (adjust range based on your users)
            'brand_id' => $brand ? $brand->id : null, // Assign a random brand (or null if none exist)
            'category_id' => $category ? $category->id : null, // Assign a random category (or null if none exist)
            'name' => $name,
            'slug' => Str::slug($name . '.' . uniqid()), // Ensure unique slug
            'description' => $this->faker->sentence(10), // Random description
            'price' => $this->faker->randomFloat(2, 10, 1000), // Price between 10 and 1000
            'discount' => $this->faker->randomFloat(2, 0, 50), // Discount between 0 and 50
            'quantity' => $this->faker->numberBetween(0, 100), // Quantity between 0 and 100
            'is_available' => $this->faker->boolean(80), // 80% chance of being available
            'image' => $this->faker->imageUrl(640, 480, 'technics'), // Random image URL
        ];
    }
}