<?php

namespace App\Services;

use App\Models\Child;
use App\Models\Manager;
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
            'Teacher' => $this->createTeacher($user, $userData),
            'Child' => $this->createChild($user, $userData),
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
    private function createTeacher(User $user, array $userData): Teacher
    {
        return Teacher::create([
            'user_id' => $user->id,
            'kindergarten_id' => $userData['kindergarten_id'],
            'specialization'=> $userData['specialization'],
        ]);
    }

    /**
     * Create parent linked to the user.
     */
    private function createChild(User $user, array $userData): Child
    {
        $child = Child::create([
        'user_id' => $user->id,
        'classroom_id' => $userData['classroom_id'],
        'nationality' => $userData['nationality'],
        'address' => $userData['address'],
        'description' => $userData['description'],
        ]);

        $this->createParentsForChild($child, $userData['parents'] ?? []);

        return $child;
    }

    private function createParentsForChild(Child $child, array $parents): void
    {
        foreach ($parents as $parentData) {
            if (!empty($parentData['name']) && !empty($parentData['phone'] && !empty($parentData['relationship'] && !empty($parentData['work_address'])))) {
                $child->parentts()->create([
                    'name' => $parentData['name'],
                    'relationship' => $parentData['relationship'] ?? null,
                    'phone' => $parentData['phone'],
                    'work_address' => $parentData['work_address'] ?? null,
                ]);
            }
        }
    }

    public function updateUser(array $data, int $id): bool
    {
        $user = User::findOrFail($id);

        $userData = collect($data)->only([
            'first_name',
            'second_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'birth_date',
        ])->toArray();

        if (!empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        $user->update($userData);

        if ($user->hasRole('teacher')) {
            $this->updateTeacher($user, $data);
        }

        if ($user->hasRole('child')) {
            $this->updateChild($user, $data);
        }

        return true;
    }

    /**
     * Update teacher related data.
     */
    private function updateTeacher(User $user, array $data): void
    {
        if (isset($data['specialization'], $data['kindergarten_id'])) {
            $user->teacher->update([
                'specialization' => $data['specialization'],
                'kindergarten_id' => $data['kindergarten_id'],
            ]);
        }
    }

    /**
     * Update child related data and parents.
     */
    private function updateChild(User $user, array $data): void
    {
        if (!$user->child) return;

        $user->child->update([
            'classroom_id' => $data['classroom_id'] ?? null,
            'nationality' => $data['nationality'] ?? null,
            'address' => $data['address'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        $user->child->parentts()->delete();

        foreach ($data['parents'] ?? [] as $parent) {
            if (!empty($parent['name'])) {
                $user->child->parentts()->create([
                    'name' => $parent['name'],
                    'relationship' => $parent['relationship'] ?? null,
                    'phone' => $parent['phone'] ?? null,
                    'work_address' => $parent['work_address'] ?? null,
                ]);
            }
        }
    }
}

