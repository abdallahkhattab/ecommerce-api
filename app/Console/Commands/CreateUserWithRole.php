<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateUserWithRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user and assign a role interactively';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get email and password from arguments
        $name = $this->ask('name');
        $email = $this->ask('email');
        $password = $this->secret('password');

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address.');
            return 1;
        }

        // Prompt user to select a role
        $roleOptions = [
            '1' => 'admin',
            '2' => 'editor',
            '3' => 'viewer',
            '4' => 'no role',
        ];

        $selectedRoleKey = $this->choice(
            'Select a role for the user:',
            array_values($roleOptions),
            null,
            null,
            true // Allow free-text input (e.g., "4" for no role)
        );

        // Map the selected role key to the role name
        $selectedRoleName = array_search($selectedRoleKey, $roleOptions);

        // Create the user
        $user = User::create([
            'name' => $name, // You can modify this to accept a name argument if needed
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Assign the role to the user (if not "no role")
        if ($selectedRoleName !== '4') {
            $role = Role::where('name', $selectedRoleName)->first();

            if (!$role) {
                $this->error("Role '{$selectedRoleName}' does not exist.");
                return 1;
            }

            $user->roles()->attach($role);
        }

        // Confirm success
        $this->info("User created successfully with email: {$email}");

        if ($selectedRoleName === '4') {
            $this->info('No role assigned.');
        } else {
            $this->info("Role assigned: {$selectedRoleName}");
        }

        return 0;
    }
}