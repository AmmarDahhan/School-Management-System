<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradeController as GradesGradeController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\StudentsController;
use App\Http\Controllers\Teachers\TeachersController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


require __DIR__ . '/auth.php';

// تعريف مسارات عامة لا تحتاج للترجمة (Livewire)
// Route::middleware('web')->group(function () {
//     // Livewire ثابتة
//     // لا تضيف لها /ar أو /en
//     // لا تحتاج إلى \Livewire\Livewire::routes() في Livewire 3 لأنها تُسجّل تلقائيًا.
//     //Parent
// });

Route::group(['middleware' => ['guest']], function () {
    // تعريف مسار GET لعرض صفحة تسجيل الدخول
    Route::get('/', [AdminController::class, 'index'])->name('login');

    // تعريف مسار POST لمعالجة بيانات تسجيل الدخول
    Route::post('/login', [AdminController::class, 'store'])->name('login');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {


        Route::post('logout', [AdminController::class, 'destroy'])->name('logout');

        Route::view('dashboard', 'dashboard')
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::view('profile', 'profile')
            ->middleware(['auth'])
            ->name('profile');

        //==============================Grades============================
        Route::resource('Grades', GradesGradeController::class);


        // //==============================Classrooms============================
        Route::resource('Classrooms', ClassroomController::class);
        Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
        Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');

        //==============================Sections============================
        Route::resource('Sections', SectionController::class);
        Route::get('/classes/{id}', [SectionController::class, 'getclasses']);

        //==============================Parents============================
        Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

        //==============================Teachers============================
        Route::resource('Teachers', TeachersController::class);

        //==============================Students============================
        Route::resource('Students', StudentsController::class);
        Route::get('/Get_classrooms/{id}', [StudentsController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentsController::class, 'Get_Sections']);
        Route::post('Upload_attachment', [StudentsController::class, 'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentsController::class, 'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [StudentsController::class, 'Delete_attachment'])->name('Delete_attachment');

        Route::resource('Promotion', PromotionController::class);

        Route::get('/{page}', [AdminController::class, 'index'])
            ->where('page', '^(?!livewire).*$');
    }
);




// Route::group(['namespace' => 'Grades'], function () {
//     Route::resource('Grades', GradeController::class);
// });
