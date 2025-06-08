<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['super-admin', 'manager', 'parent'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'display_name' => ucfirst( $role),
                'description' => ucfirst($role) . ' role',
            ]);
        }
    }
}
