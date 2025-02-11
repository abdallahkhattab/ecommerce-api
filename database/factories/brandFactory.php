<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\brand>
 */
class brandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            
            'name' => $this->faker->company, // Generate a random company name
        ];

       // $brandNames = ['Apple', 'Samsung', 'Sony', 'Microsoft', 'Google', 'Dell', 'HP', 'Lenovo', 'Asus', 'Canon'];
      //  $name = $this->faker->randomElement($brandNames);
/*
        return [ 
            'name' => $name,
        ];*/


    }
}
