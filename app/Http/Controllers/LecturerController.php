<?php

namespace App\Http\Controllers;

use App\Exports\SubjectResultsExport;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class LecturerController extends Controller
{
    public function index()
    {
        // Show dashboard with summary
        $exams = Exam::with('subject')->latest()->take(5)->get();
        $subjects = Subject::all();
        $students = User::whereHas('role', function ($query) {
            $query->where('name', 'Student');
        })->count();

        return view('lecturer.dashboard', compact('exams', 'subjects', 'students'));
    }

    public function viewResults()
    {
        // View submitted results
        $exams = Exam::with('subject')->get();

        return view('lecturer.results.index', compact('exams'));
    }

    public function showExamResults(Exam $exam)
    {
        $students = $exam->students()->with(['answers.question'])->get();
        $totalQuestions = $exam->questions()->count();

        return view('lecturer.results.exam', compact('exam', 'students', 'totalQuestions'));
    }

    public function studentScores()
    {
        $exams = Exam::with(['subject', 'questions.answers.user'])->get();

        return view('lecturer.students.scores', compact('exams'));
    }

    public function exportSubjectResults(Subject $subject)
    {
        return Excel::download(new SubjectResultsExport($subject), 'subject_'.$subject->id.'_results.xlsx');
    }
}
