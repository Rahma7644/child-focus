<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
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
}
