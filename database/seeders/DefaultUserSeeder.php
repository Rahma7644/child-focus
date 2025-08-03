<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['phone' => '921234567'],
            [
            'first_name' => 'Super',
            'second_name' => 'User',
            'last_name' => 'Admin',
            'email' => 'super_admin@cf.com',
            'birth_date' => '1990-01-01',
            'gender' => 1,
            'is_active' => 1,
            'password' => Hash::make('password'),
            ]
        );

        $user->addRole('Super-admin');
    }
}
