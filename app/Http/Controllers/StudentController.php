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

        $exams = Exam::whereHas('subject', fn ($q) => $q->where('class_group_id', $classId))->get();

        return view('student.dashboard', compact('exams'));
    }

    public function allResults()
    {
        $user = Auth::user();

        // Fetch all exams the user has answered
        $answers = $user->answers()
            ->with(['question.options', 'question.exam'])
            ->get()
            ->groupBy(fn ($a) => $a->question->exam_id);

        $results = [];

        foreach ($answers as $examId => $examAnswers) {
            $exam = $examAnswers->first()->question->exam;
            $questions = $exam->questions;
            $total = $questions->count();
            $correct = 0;

            foreach ($questions as $question) {
                $answer = $examAnswers->firstWhere('question_id', $question->id);
                if ($question->type === 'mcq' && $answer) {
                    $correctOption = $question->options->firstWhere('is_correct', true);
                    if ($correctOption && $answer->answer_text === $correctOption->option_text) {
                        $correct++;
                    }
                }
            }

            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

            $results[] = [
                'exam' => $exam,
                'total' => $total,
                'correct' => $correct,
                'percentage' => $percentage,
                'submitted_at' => $examAnswers->first()->created_at,
            ];
        }

        return view('student.results', compact('results'));
    }

    public function showExam(Exam $exam)
    {
        $exam->load('questions.options');

        return view('student.exam', compact('exam'));
    }

    public function submitExam(Request $request, Exam $exam)
    {
        $userId = Auth::id();
        $allQuestions = $exam->questions;

        $answers = $request->input('answers');

        foreach ($allQuestions as $question) {
            $answer = $answers[$question->id] ?? null;

            $isCorrect = null;
            if ($question->type === 'mcq') {
                $correctOption = $question->options()->where('is_correct', true)->first();
                $isCorrect = trim($answer) === $correctOption?->option_text;
            }

            Answer::updateOrCreate(
                ['user_id' => $userId, 'question_id' => $question->id],
                [
                    'answer_text' => $answer,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        return redirect()->route('student.dashboard')->with('success', 'Exam submitted');
    }
}
