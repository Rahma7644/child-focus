<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // User data
        $userData = $request->only(
            'first_name',
            'second_name',
            'last_name',
            'email',
            'phone',
            'gender',
            'birth_date',
            'password'
        );

        // Kindergarten data
        $kgData = $request->only(
            'kgName',
            'kgLocation',
            'kgPhone',
        );

        // Logo
        $kgLogo = $request->file('kgLogo');

        $kg = $this->registrationService->registerUserWithKg($userData, $kgData, $kgLogo);
        $user = $kg->manager->user;

        Auth::login($user);

        Session::flash('success', 'Registration successful! Welcome.');

        return redirect()->route('home');
    }
}
