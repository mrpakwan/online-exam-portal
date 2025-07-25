<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('subject')->get();

        return view('lecturer.exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = Subject::get();

        // $subjects = Subject::where('lecturer_id', Auth::id())->get();
        $optSubjects = [];
        foreach ($subjects as $subject) {
            $optSubjects[] = [
                'value' => $subject->id,
                'name' => $subject->name,
            ];
        }

        return view('lecturer.exams.create', compact('optSubjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'duration' => 'required|integer|min:1',
        ]);

        Exam::create($request->only('title', 'subject_id', 'duration'));

        return redirect()->route('lecturer.exams.index')->with('success', 'Exam created');
    }

    public function viewSubmissions(Exam $exam)
    {
        $students = User::where('role', 'Student')
            ->whereHas('answers.question.exam', fn ($q) => $q->where('exam_id', $exam->id))
            ->with(['answers' => function ($q) use ($exam) {
                $q->whereHas('question', fn ($subQ) => $subQ->where('exam_id', $exam->id));
            }])
            ->get();

        $totalQuestions = $exam->questions()->where('type', 'mcq')->count();

        return view('lecturer.exams.submissions', compact('exam', 'students', 'totalQuestions'));
    }

    public function leaderboard()
    {
        $students = User::where('role', 'Student')->with('answers.question.exam')->get();

        $scores = [];

        foreach ($students as $student) {
            $totalCorrect = $student->answers->where('is_correct', true)->count();
            $totalMcq = $student->answers->filter(fn ($a) => $a->question->type === 'mcq')->count();

            $percentage = $totalMcq > 0 ? round(($totalCorrect / $totalMcq) * 100, 2) : 0;

            $scores[] = [
                'name' => $student->name,
                'correct' => $totalCorrect,
                'total' => $totalMcq,
                'score' => $percentage,
            ];
        }

        usort($scores, fn ($a, $b) => $b['score'] <=> $a['score']);

        return view('lecturer.exams.leaderboard', compact('scores'));
    }

    public function grade(Exam $exam)
    {
        $answers = Answer::whereHas('question', fn ($q) => $q->where('exam_id', $exam->id)->where('type', 'open'))
            ->with(['question', 'student'])
            ->get()
            ->groupBy('question_id');

        return view('lecturer.exams.grade', compact('exam', 'answers'));
    }

    public function submitGrade(Request $request, Answer $answer)
    {
        $request->validate([
            'is_correct' => 'required|boolean',
        ]);

        $answer->update(['is_correct' => $request->is_correct]);

        return back()->with('success', 'Answer graded.');
    }
}
