<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class StudentExamController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        // Assuming user has class_group_id
        $classGroup = $student->classGroup;

        if (! $classGroup) {
            return view('student.exams.index', ['exams' => collect()]);
        }

        $exams = Exam::with('subject')
            ->where('class_group_id', $classGroup->id)
            ->get();

        return view('student.exams.index', compact('exams'));
    }
}
