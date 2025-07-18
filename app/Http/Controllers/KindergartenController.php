<?php

namespace App\Http\Controllers;

use App\Http\Requests\kindergartenRequest;
use App\Models\Kindergarten;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KindergartenController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $KGs = Kindergarten::all();

        return view('pages.kindergartens.index', compact('KGs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(kindergartenRequest $request)
    {
        $data = $request->validated();

        $kgData = [
            'name' => $data['kgName'],
            'address' => $data['kgLocation'],
            'phone' => $data['kgPhone'],
        ];
        // Upload logo if available
        if ($request->hasFile('kgLogo')) {
            $logoPath = $request->file('kgLogo')->store('kg_logos', 'public');
            $kgData['logo'] = $logoPath;
        }

        $managerId = $data['manager_id'] ?? null;
        DB::transaction(function () use (&$managerId, $kgData, $data) {
            if (!$managerId) {

                $userData = [
                    'first_name' => $data['first_name'],
                    'second_name' => $data['second_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'gender' => $data['gender'],
                    'birth_date' => $data['birth_date'],
                    'password' => Hash::make($data['password']),
                    'role' => 'Manager',
                ];

                $manager = $this->userService->createUser($userData);
                $managerId = $manager->id;
            }

            $kgData['manager_id'] = $managerId;

            Kindergarten::create($kgData);
        });

        return redirect()->route('kindergartens.index')->with('success', 'تمت اضافة الروضة بنجاح !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kindergarten $kindergarten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kindergarten $kindergarten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KindergartenRequest $request, $id)
    {
        $data = $request->validated();

        $kindergarten = Kindergarten::findOrFail($id);

        $kgData = [
            'name' => $data['kgName'],
            'address' => $data['kgLocation'],
            'phone' => $data['kgPhone'],
        ];
        if ($request->hasFile('kgLogo')) {
            // Delete old logo from storage
            if ($kindergarten->logo && Storage::disk('public')->exists($kindergarten->logo)) {
                Storage::disk('public')->delete($kindergarten->logo);
            }

            // Upload new logo
            $logoPath = $request->file('kgLogo')->store('kg_logos', 'public');
            $kgData['logo'] = $logoPath;
        }


        $managerId = $data['manager_id'] ?? null;

        DB::transaction(function () use (&$managerId, $data, $kgData, $kindergarten) {
            if (!$managerId) {
                // Create a new manager
                $userData = [
                    'first_name' => $data['first_name'],
                    'second_name' => $data['second_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'gender' => $data['gender'],
                    'birth_date' => $data['birth_date'],
                    'password' => Hash::make($data['password']),
                    'role' => 'Manager',
                ];

                $manager = $this->userService->createUser($userData);
                $managerId = $manager->id;
            }

            // Update kindergarten data
            $kgData['manager_id'] = $managerId;
            $kindergarten->update($kgData);
        });

        return redirect()->route('kindergartens.index')->with('success', 'تم تحديث بيانات الروضة بنجاح!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kindergarten $kindergarten)
    {
        //
    }

}
