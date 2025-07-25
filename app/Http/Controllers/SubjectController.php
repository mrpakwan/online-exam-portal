<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('classGroup')->get();

        return view('lecturer.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $classGroups = ClassGroup::all();

        return view('lecturer.subjects.create', compact('classGroups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_group_id' => 'required|exists:class_groups,id',
        ]);

        Subject::create($request->all());

        return redirect()->route('lecturer.subjects.index')->with('success', 'Subject created.');
    }

    public function edit(Subject $subject)
    {
        $classGroups = ClassGroup::all();

        return view('lecturer.subjects.edit', compact('subject', 'classGroups'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_group_id' => 'required|exists:class_groups,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('lecturer.subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('lecturer.subjects.index')->with('success', 'Subject deleted.');
    }
}
