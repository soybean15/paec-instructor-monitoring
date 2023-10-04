<?php

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

    $user =  $request->user();
    $user->load(['roles']);
    return $user;
});



Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::prefix('/')->group(function(){

        Route::get('profile',[UserController::class,'index']);
        Route::get('is-admin',[UserController::class,'isAdmin']);
    });

   


});

Route::prefix('admin')->middleware(['auth:sanctum','isAdmin'])->group(function(){






});
