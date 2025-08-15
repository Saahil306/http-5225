<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfessorController;

Route::get('/', function () {
    return view('welcome');
});

// ------------------- Students -------------------
// Soft delete (trash) a student
Route::get('students/trash/{id}', [StudentController::class, 'trash'])->name('students.trash');

// View all trashed students
Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');

// Restore a trashed student
Route::get('students/restore/{id}', [StudentController::class, 'restore'])->name('students.restore');

// Full CRUD for students
Route::resource('students', StudentController::class);

// ------------------- Courses -------------------
// Full CRUD for courses
Route::resource('courses', CourseController::class);

// ------------------- Professors -------------------
// Full CRUD for professors
Route::resource('professors', ProfessorController::class);
