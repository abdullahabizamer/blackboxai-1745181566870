<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Student\QuestionController as StudentQuestionController;
use App\Http\Controllers\Student\ProgressController;
use Illuminate\Support\Facades\Auth;

// Redirect root to student questions index
Route::get('/', function () {
    return redirect()->route('student.questions.index');
});

// Authentication routes (Laravel Breeze or UI can be used for full auth)
Auth::routes();

// Admin routes group with middleware for admin role
Route::middleware(['auth', 'can:isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('questions', QuestionController::class);
});

// Student routes group with auth middleware
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('questions', [StudentQuestionController::class, 'index'])->name('questions.index');
    Route::get('questions/{question}', [StudentQuestionController::class, 'show'])->name('questions.show');
    Route::post('questions/{question}/answer', [StudentQuestionController::class, 'answer'])->name('questions.answer');

    Route::get('progress', [ProgressController::class, 'index'])->name('progress.index');
});
