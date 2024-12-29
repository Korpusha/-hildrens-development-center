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
        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'test12345',
        ]);
        $adminUser->roles()->attach(RoleName::Admin->value);

        $guestUser = User::factory()->create([
            'email' => 'guest@example.com',
            'password' => 'test12345',
        ]);
        $guestUser->roles()->attach(RoleName::Guest->value);

        $tutorUser = User::factory()->create([
            'email' => 'tutor@example.com',
            'password' => 'test12345',
        ]);
        $tutorUser->roles()->attach(RoleName::Tutor->value);
        $tutorUser->tutor()->create();
    }
}
