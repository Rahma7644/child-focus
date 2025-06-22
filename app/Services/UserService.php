<?php

namespace App\Services;

use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create user record.
     */
    /**
     * Create user record.
     */
    public function createUser(array $userData): User
    {
        DB::beginTransaction();
        $user = User::create([
            'first_name' => $userData['first_name'],
            'second_name' => $userData['second_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'phone' => $userData['phone'],
            'gender' => $userData['gender'],
            'birth_date' => $userData['birth_date'],
            'password' => Hash::make($userData['password']),
        ]);

        // add role to user with laratrust
        $user->addRole(Role::whereDisplayName($userData['role'])->first());

        DB::commit();

        return $user;
    }

    /**
     * Create manager linked to the user.
     */
    private function createManager(User $user): Manager
    {
        return Manager::create([
            'user_id' => $user->id,
        ]);
    }
}
