<?php

namespace App\Http\Controllers;

use App\Exports\ExamResultsExport;
use App\Models\Exam;
use Maatwebsite\Excel\Facades\Excel;

class ResultExportController extends Controller
{
    public function export(Exam $exam)
    {
        $filename = 'exam_results_'.$exam->id.'.xlsx';

        return Excel::download(new ExamResultsExport($exam), $filename);
    }
}
