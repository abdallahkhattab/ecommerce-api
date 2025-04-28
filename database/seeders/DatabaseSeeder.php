<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //$this->call(BrandSeeder::class);
      //  $this->call(RoleSeeder::class);
                // Seed role-user relationships
                //$this->call(RoleUserSeeder::class);

        // $this->call(CategorySeeder::class);

        $this->call([
           RoleSeeder::class, // Seed roles (admin, editor, seller)
            UserSeeder::class, // Seed users with roles
           BrandSeeder::class, // Seed brands
         CategorySeeder::class, // Seed categories
            ProductSeeder::class, // Seed products
        ]);



    }
}
