<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        return [
            //
            'name' => $this->faker->word, // Random word as category name
            'slug' => $this->faker->unique()->slug, // Unique slug
            'description' => $this->faker->sentence(10), // Random description
            'image' => $this->faker->imageUrl(640, 480, 'fashion'), // Random image URL
        ];*/

        $categoryNames = ['Electronics', 'Clothing', 'Books', 'Home Decor', 'Gadgets', 'Sports', 'Toys', 'Beauty', 'Furniture', 'Jewelry'];
        $name = $this->faker->randomElement($categoryNames);

        return [ 
            'name' => $name,
            'slug' => Str::slug($name . '.' . uniqid()),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
        ];
    }
}
