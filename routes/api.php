<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {



    return $request->user();
    ;
});



Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

  
    Route::prefix('/')->group(function () {
        Route::get('/departments', [DepartmentController::class, 'getDepartments']);
        Route::get('profile', [UserController::class, 'index']);
        Route::get('is-admin', [UserController::class, 'isAdmin'])->middleware(['isProfileComplete','isTeacher']);
        Route::post('update/{id}', [UserController::class, 'updateProfile']);
        Route::post('/teacher',[TeacherController::class,'store']);
    });




});


//localhost:8000/api/admin/subject/
Route::prefix('admin')->middleware(['auth:sanctum', 'isAdmin'])->group(function () {

    Route::prefix('subject')->group(function () {


        Route::get('/', [SubjectController::class, 'index']);
        Route::get('/all', [SubjectController::class, 'getSubjects']);
        Route::post('/store', [SubjectController::class, 'store']);
        Route::post('/update', [SubjectController::class, 'update']);
        Route::post('/destroy', [SubjectController::class, 'destroy']);
        Route::get('search/', [SubjectController::class, 'search']);
    });


    Route::prefix('course')->group(function () {

        Route::get('/', [CourseController::class, 'index']);
        Route::get('/all', [CourseController::class, 'getCourses']);
        Route::post('/store', [CourseController::class, 'store']);
        Route::post('/update', [CourseController::class, 'update']);
        Route::post('/destroy', [CourseController::class, 'destroy']);
        Route::get('search/', [CourseController::class, 'search']);
    });

    Route::prefix('department')->group(function () {

        Route::get('/', [DepartmentController::class, 'index']);
        Route::post('/store', [DepartmentController::class, 'store']);
        Route::post('/update', [DepartmentController::class, 'update']);
        Route::post('/destroy', [DepartmentController::class, 'destroy']);
        Route::get('search/', [DepartmentController::class, 'search']);

    });

    Route::prefix('teacher')->group(function () {


        Route::prefix('pending')->group(function () {
            Route::get('/', [TeacherController::class, 'pending']);
            Route::post('/accept/{id}', [TeacherController::class, 'accept']);
            Route::post('/reject/{id}', [TeacherController::class, 'reject']);
        });

        Route::get('/',[TeacherController::class,'index']);
        Route::get('/{id}',[TeacherController::class,'getTeacher']);
        Route::post('/subjects/{id}',[TeacherController::class,'insertSubjects']);
        Route::get('/available-subjects/{id}',[TeacherController::class,'getAvailableSubjects']);

    });




});
