<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($role)
    {
        // Validate the role
        if (!in_array($role, ['manager', 'teacher', 'parent'])) {
            return abort(404, 'Role not found');
        }

        // // Fetch users with the specified role
        $users = User::whereHasRole($role)->get();
        return view('pages.users.index', [
            'users' => $users,
            'role' => ucfirst($role),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $userData = $request->validated();

        $user = $this->userService->createUser($userData);

        return redirect()->route('users.index', strtolower($userData['role']))->with('success', ' تمت اضافة المستخدم بنجاح !');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $data = $request->only([
                'first_name',
                'second_name',
                'last_name',
                'email',
                'phone',
                'gender',
                'birth_date',
            ]);

            // update password if it's provided
            if ($request->filled('password')) {
               $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->back()->with('success', 'تم تحديث بيانات المستخدم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث المستخدم');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['status' => 'success', 'message' => 'تمت أرشفة المستخدم بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'حدث خطأ أثناء أرشفة المستخدم'], 500);
        }
    }

    public function restore($id)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($id);
            $user->restore();
            return response()->json(['status' => 'success', 'message' => 'تمت استعادة المستخدم بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'حدث خطاء اثناء استعادة المستخدم'], 500);
        }
    }

    /**
     * Change user state
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'message' => $user->is_active ? 'تم التفعيل بنجاح'  : 'تم التعطيل بنجاح'
        ]);
    }

    public function archive()
    {
        $users = User::onlyTrashed()->get();
        return view('pages.users.archive', compact('users'));
    }


}
