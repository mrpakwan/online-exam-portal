<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $now = now();
        $user = Auth::user();
        $classId = $user->class_group_id;

        $exams = Exam::whereHas('subject', fn ($q) => $q->where('class_group_id', $classId)
        )
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->get();

        return view('student.dashboard', compact('exams'));
    }

    public function showExam(Exam $exam)
    {
        $exam->load('questions.options');

        return view('student.exam', compact('exam'));
    }

    public function submitExam(Request $request, Exam $exam)
    {
        $userId = Auth::id();

        foreach ($request->answers as $questionId => $answer) {
            $question = $exam->questions()->find($questionId);

            $isCorrect = null;
            if ($question->type === 'mcq') {
                $correctOption = $question->options()->where('is_correct', true)->first();
                $isCorrect = trim($answer) === $correctOption?->option_text;
            }

            Answer::updateOrCreate(
                ['user_id' => $userId, 'question_id' => $questionId],
                [
                    'answer_text' => $answer,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        return redirect()->route('student.dashboard')->with('success', 'Exam submitted');
    }
}
