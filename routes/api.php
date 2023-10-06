<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {


   
    return $request->user();;
});



Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::prefix('/')->group(function(){

        Route::get('profile',[UserController::class,'index']);
        Route::get('is-admin',[UserController::class,'isAdmin']);
    });

   


});


//localhost:8000/api/admin/subject/
Route::prefix('admin')->middleware(['auth:sanctum','isAdmin'])->group(function(){

    Route::prefix('subject')->group(function(){


        Route::get('/',[SubjectController::class,'index']);
        Route::post('/store',[SubjectController::class,'store']);


    });


    Route::prefix('course')->group(function(){

         Route::get('/', [CourseController::class, 'index']);
         Route::post('/store',[CourseController::class,'store']);
    });

    Route::prefix('department')->group(function(){

        Route::get('/', [DepartmentController::class, 'index']);
        Route::post('/store',[DepartmentController::class,'store']);

   });




});
