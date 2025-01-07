<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseBatchController;
use App\Http\Controllers\StudentCourseBatchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/studentRegister', function () {
            return view('studentRegister');
        })->name('studentRegister');

    Route::resource('students', StudentController::class);
    // Define a custom route for courses
    Route::get('students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');

    Route::resource('payments', PaymentController::class);

    Route::resource('courses', CourseController::class);
    Route::get('batches/{batch}/batches', [CourseController::class, 'batches'])->name('courses.batches');

    Route::resource('course_batches', CourseBatchController::class);

    Route::resource('student_course_batch', StudentCourseBatchController::class);
    });


require __DIR__.'/auth.php';
