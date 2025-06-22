<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['phone' => '921234567'],
            [
            'first_name' => 'Test',
            'second_name' => 'User',
            'last_name' => 'One',
            'email' => 'testuser@example.com',
            'birth_date' => '1990-01-01',
            'gender' => 1, // Or 0, depending on your logic
            'is_active' => 1,
            'password' => Hash::make('password'),
            ]
        );
    }
}
