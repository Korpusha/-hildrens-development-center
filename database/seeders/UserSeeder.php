<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testUser = User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'middle_name' => 'Mid',
            'date_of_birth' => '2000-01-01',
            'email' => 'test@example.com',
            'password' => 'test12345',
        ]);
         $testUser->roles()->attach(RoleName::ADMIN->value);
    }
}
