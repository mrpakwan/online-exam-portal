<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Http\Request;

class ClassGroupController extends Controller
{
    public function index()
    {
        $classGroups = ClassGroup::withCount('students')->get();

        return view('lecturer.classes.index', compact('classGroups'));
    }

    public function create()
    {
        return view('lecturer.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ClassGroup::create($request->only('name'));

        return redirect()->route('lecturer.classes.index')->with('success', 'Class created successfully.');
    }

    public function edit(ClassGroup $classGroup)
    {
        return view('lecturer.classes.edit', compact('classGroup'));
    }

    public function update(Request $request, ClassGroup $classGroup)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $classGroup->update($request->only('name'));

        return redirect()->route('lecturer.classes.index')->with('success', 'Class updated.');
    }

    public function assign(ClassGroup $classGroup)
    {
        $students = User::whereHas('role', function ($query) {
            $query->where('name', 'Student');
        })->get();

        return view('lecturer.classes.assign', compact('classGroup', 'students'));
    }

    public function assignStore(Request $request, ClassGroup $classGroup)
    {
        $studentIds = $request->input('student_ids', []);

        // Set class_group_id for selected students
        User::whereIn('id', $studentIds)->update(['class_group_id' => $classGroup->id]);

        // Optionally, remove class from students not selected
        User::where('class_group_id', $classGroup->id)
            ->whereNotIn('id', $studentIds)
            ->update(['class_group_id' => null]);

        return redirect()->route('lecturer.classes.index')->with('success', 'Students assigned successfully.');
    }
}
