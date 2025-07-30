<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\CTRequest;
use App\Models\classroom;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClassroomController extends Controller
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
        $classrooms = classroom::all();
        return view('pages.classrooms.index', compact('classrooms'));
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
    public function store(ClassroomRequest $request)
    {
        $data = $request->validated();

        // Upload image if available
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('classrooms_images', 'public');
        }

        classroom::create($data);

        return redirect()->route('classrooms.index')->with('success','تم اضافة الفصل الدراسي بنجاح !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);

        return view('pages.classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(classroom $classroom)
    {
        //
    }

    public function attachTeacher(CTRequest $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        $data = $request->validated();
        $teacherId = $data['teacher_id'] ?? null;

        DB::transaction(function () use (&$teacherId, $data, $classroom) {
            if (!$teacherId) {

                $userData = [
                    'first_name' => $data['first_name'],
                    'second_name' => $data['second_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'gender' => $data['gender'],
                    'birth_date' => $data['birth_date'],
                    'password' => Hash::make($data['password']),
                    'role' => 'Teacher',
                    'kindergarten_id' => $classroom->kindergarten->id,
                    'specialization' => $data['specialization'],
                ];

                $teacher = $this->userService->createUser($userData);
                $teacherId = $teacher->id;
            }

            $classroom->teachers()->attach([$teacherId]);
        });
        return redirect()->route('classrooms.show', $classroom->id)->with('success', 'تمت اضافة المعلم للفصل الدراسي بنجاح !');
    }

    public function detachTeacher( $classroomId, $teacherId)
    {
        $classroom = Classroom::findOrFail($classroomId);
        $classroom->teachers()->detach([$teacherId]);
    }
}
