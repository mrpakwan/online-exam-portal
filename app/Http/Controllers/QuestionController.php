<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Exam $exam)
    {
        $exam->load('questions.options');

        return view('lecturer.questions.index', compact('exam'));
    }

    public function create(Exam $exam)
    {
        $optQuestionTypes = Question::QUESTION_TYPES;

        return view('lecturer.questions.create', compact('exam', 'optQuestionTypes'));
    }

    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'type' => 'required|in:mcq,open',
            'question_text' => 'required',
            'options' => 'sometimes|array',
            'options.*' => 'required_if:type,mcq',
            'correct_option' => 'required_if:type,mcq',
        ]);

        $question = $exam->questions()->create([
            'type' => $request->type,
            'question_text' => $request->question_text,
        ]);

        if ($request->type === 'mcq') {
            foreach ($request->options as $index => $text) {
                $question->options()->create([
                    'option_text' => $text,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        }

        return redirect()->route('lecturer.exams.index');
    }

    public function edit(Exam $exam, Question $question)
    {
        $question->load('options');

        return view('lecturer.questions.edit', compact('exam', 'question'));
    }

    public function update(Request $request, Exam $exam, Question $question)
    {
        $request->validate([
            'question_text' => 'required',
            'options.*' => 'required_if:type,mcq',
            'correct_option' => 'required_if:type,mcq',
        ]);

        $question->update([
            'question_text' => $request->question_text,
        ]);

        if ($question->type === 'mcq') {
            // Clear existing options
            $question->options()->delete();

            foreach ($request->options as $index => $text) {
                $question->options()->create([
                    'option_text' => $text,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }
        }

        return redirect()->route('lecturer.questions.index', $exam)->with('success', 'Question updated.');
    }
}
