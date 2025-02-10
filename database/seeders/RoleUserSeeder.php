<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Get all users
        $users = User::all();

        // Get all roles
        $roles = Role::all();

        // Assign roles to users
        foreach ($users as $user) {
            // Assign a random role to each user
            $randomRole = $roles->random(); // Pick a random role
            $user->roles()->attach($randomRole);

            // Optionally, assign multiple roles to a user
            // $user->roles()->attach($roles->pluck('id')->toArray());
        }
    }
}
