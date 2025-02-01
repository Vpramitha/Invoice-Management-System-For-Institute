<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseBatchController;
use App\Http\Controllers\StudentCourseBatchController;
use App\Http\Controllers\excelExportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BrokerController;

use App\Models\CourseBatch;

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
})->middleware(['auth', 'verified', 'prevent-back-button'])->name('dashboard');

Route::middleware(['auth', 'prevent-back-button'])->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/studentRegister', function () {
            return view('studentRegister');
        })->name('studentRegister');

    Route::resource('students', StudentController::class);

    Route::post('/students/search/normal', [StudentController::class, 'normalSearch'])->name('students.search.normal');
    Route::post('/students/search/advanced', [StudentController::class, 'advancedSearch'])->name('students.search.advanced');

    // Define a custom route for courses
    Route::get('students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');

    Route::get('students/{student}/payments/{invoice}', [StudentController::class, 'payments'])->name('students.payments');

    Route::resource('payments', PaymentController::class);

    Route::resource('courses', CourseController::class);
    Route::get('batches/{batch}/batches', [CourseController::class, 'batches'])->name('courses.batches');

    Route::resource('batches', CourseBatchController::class);
    Route::get('batches/{batch}/create', [CourseBatchController::class, 'create'])->name('batches.create');
    //Route::get('batches/{batch}/create', [CourseBatchController::class, 'create'])->name('batches.create');
    Route::get('/course/{course}/batch/{batch}/registered-students', [CourseBatchController::class, 'registeredStudents'])
        ->name('course.batch.registeredStudents');

    Route::resource('student_course_batch', StudentCourseBatchController::class);
    //});

    Route::get('{student}/course/batch/register', [StudentController::class, 'RegisterForNewCourse'])->name('student.course.batch.register');

Route::get('/api/course/{courseId}/batches', function ($courseId) {
    return CourseBatch::where('course_id', $courseId)->get();
});

    Route::get('/api/batch/{batchId}/details', function ($batchId) {
        return CourseBatch::find($batchId);
    });



    Route::resource('payments', PaymentController::class);

    //Route::post('/students/search/normal', [StudentController::class, 'normalSearch'])->name('students.search.normal');

    //Route::post('payment/invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');

    Route::get('payment/invoice/{invoiceId}', [PaymentController::class, 'printInvoice'])->name('payment.invoice');
    Route::get('payment/delete/invoice/{invoiceId}', [PaymentController::class, 'cancelInvoice'])->name('payment.invoice.cancel');

    //Route::get('/export-users', [excelExportController::class, 'exportUsers'])->name('export.users');
    Route::get('/Reports', [ReportController::class, 'index'])->name('report.index');
    Route::get('/export-users', [ReportController::class, 'exportUsers'])->name('export.users');
    Route::get('/export-payments', [ReportController::class, 'exportPayments'])->name('export.payments');

    Route::Resource('brokers', BrokerController::class);
    //Route::get('/brokers/create', [BrokerController::class, 'create'])->name('brokers.create');

});

require __DIR__.'/auth.php';
