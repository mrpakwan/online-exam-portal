<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubjectResultsExport implements FromCollection, WithHeadings
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function collection()
    {
        $students = collect();

        foreach ($this->subject->exams as $exam) {
            $questions = $exam->questions;
            $totalQuestions = $questions->count();

            foreach ($exam->students()->with(['answers' => function ($q) use ($exam) {
                $q->whereHas('question', fn ($subQ) => $subQ->where('exam_id', $exam->id));
            }])->get() as $student) {

                $correctAnswers = $student->answers->where('is_correct', true)->count();
                $percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

                $students->push([
                    'Student Name' => $student->name,
                    'Email' => $student->email,
                    'Exam Title' => $exam->title,
                    'Score' => $correctAnswers,
                    'Total Questions' => $totalQuestions,
                    'Percentage' => $percentage.'%',
                ]);
            }
        }

        return $students;
    }

    public function headings(): array
    {
        return ['Student Name', 'Email', 'Exam Title', 'Score', 'Total Questions', 'Percentage'];
    }
}
