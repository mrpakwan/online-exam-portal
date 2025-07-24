<?php

use App\Exports\SubjectResultsExport;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultExportController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->isLecturer()) {
        return Redirect::route('lecturer.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:Lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'index'])->name('dashboard');

    Route::get('/subjects/{subject}/export', function (\App\Models\Subject $subject) {
        return Excel::download(new SubjectResultsExport($subject), 'subject_'.$subject->id.'_results.xlsx');
    })->name('subjects.export');

    // Route::resource('exams', ExamController::class);
    Route::prefix('exams')->group(function () {
        // nav: Exam
        Route::get('/index', [ExamController::class, 'index'])->name('exams.index');
        Route::get('/create', [ExamController::class, 'create'])->name('exams.create');
        Route::post('/store', [ExamController::class, 'store'])->name('exams.store');

        // nav: Question
        Route::get('/{exam}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/{exam}/questions', [QuestionController::class, 'store'])->name('questions.store');

        Route::get('/{exam}/questions', [QuestionController::class, 'index'])->name('questions.index');
        Route::get('/{exam}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('/{exam}/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

        Route::get('/students/scores', [LecturerController::class, 'studentScores'])->name('students.scores');

        // result
        Route::get('/{exam}/result', [StudentController::class, 'viewResult'])->name('exams.result');

        // submission
        Route::get('/{exam}/submissions', [ExamController::class, 'viewSubmissions'])->name('exams.submissions');

        // leaderboard
        Route::get('/leaderboard', [ExamController::class, 'leaderboard'])->name('exams.leaderboard');

        // export
        Route::get('/{exam}/export', [ResultExportController::class, 'export'])->name('exams.export');
    });

    // grade
    Route::get('exams/{exam}/grade', [ExamController::class, 'grade'])->name('exams.grade');
    Route::post('answers/{answer}/grade', [ExamController::class, 'submitGrade'])->name('answers.grade');
});

Route::middleware(['auth', 'role:Student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('exams/{exam}', [StudentController::class, 'showExam'])->name('exam');
    Route::post('exams/{exam}', [StudentController::class, 'submitExam'])->name('exam.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
