<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Manager;
use App\Models\Kindergarten;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class RegistrationService
{
    /**
     * Handle full registration: user, manager, and kindergarten.
     *
     * @param array $userData
     * @param array $kgData
     * @param UploadedFile|null $kgLogo
     * @return Kindergarten
     * @throws \Exception
     */
    public function registerUserWithKg(array $userData, array $kgData, ?UploadedFile $kgLogo = null): Kindergarten
    {
        return DB::transaction(function () use ($userData, $kgData, $kgLogo) {
            $user = $this->createUser($userData);
            $manager = $this->createManager($user);
            $kg = $this->createKg($kgData, $manager, $kgLogo);

            return $kg;
        });
    }

    /**
     * Create user record.
     */
    private function createUser(array $userData): User
    {
        return User::create([
            'first_name' => $userData['first_name'],
            'second_name' => $userData['second_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'phone' => $userData['phone'],
            'gender' => $userData['gender'],
            'birth_date' => $userData['birth_date'],
            'password' => Hash::make($userData['password']),
        ]);
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
     * Create kg linked to the manager, and handle logo upload.
     */
    private function createKg(array $kgData, Manager $manager, ?UploadedFile $kgLogo = null): Kindergarten
    {
        $kg = new Kindergarten();
        $kg->name = $kgData['kgName'];
        $kg->address = $kgData['kgLocation'];
        $kg->phone = $kgData['kgPhone'];
        $kg->manager_id = $manager->id;

        if ($kgLogo) {
            $kg->logo = $kgLogo->store('kg_logos', 'public');
        }

        $kg->save();

        return $kg;
    }
}
