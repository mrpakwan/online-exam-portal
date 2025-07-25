<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamResultsExport implements FromCollection, WithHeadings
{
    protected $exam;

    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    public function collection()
    {
        $questions = $this->exam->questions;
        $totalQuestions = $questions->count();

        $students = $this->exam->students()
            ->with(['answers' => function ($q) {
                $q->with('question');
            }])
            ->get();

        return $students->map(function ($student) use ($totalQuestions) {
            $score = $student->answers
                ->filter(fn ($a) => $a->question->exam_id === $this->exam->id)
                ->filter(fn ($a) => $a->is_correct === true)
                ->count();

            $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100, 2) : 0;

            return [
                'Student Name' => $student->name,
                'Email' => $student->email,
                'Score' => $score,
                'Total Questions' => $totalQuestions,
                'Percentage' => $percentage.'%',
            ];
        });
    }

    public function headings(): array
    {
        return ['Student Name', 'Email', 'Score', 'Total Questions', 'Percentage'];
    }
}
