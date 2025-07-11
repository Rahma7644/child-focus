<?php

namespace App\Services;

use App\Models\Manager;
use App\Models\Parentt;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create user record.
     */
    public function createUser(array $userData)
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
        $roleName = $userData['role'];
        $user->addRole(Role::whereDisplayName($roleName)->first());

        $relatedModel = match ($roleName) {
            'Manager' => $this->createManager($user),
            'Teacher' => $this->createTeacher($user),
            'Parent' => $this->createParent($user),
            default => null,
        };

        DB::commit();

        return $relatedModel;
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

    /**
     * Create manager linked to the user.
     */
    private function createTeacher(User $user): Teacher
    {
        return Teacher::create([
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create parent linked to the user.
     */
    private function createParent(User $user): Parentt
    {
        return Parentt::create([
            'user_id' => $user->id,
        ]);
    }
}
