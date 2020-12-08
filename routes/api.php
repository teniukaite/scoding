<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {

    Route::post('login',[LoginController::class,'login']);
    Route::post('relog',[LoginController::class,'relog']);
    Route::post('logout',[LoginController::class,'logout']);
    Route::post('me',[MeController::class,'create']);
    Route::post('register',[RegisterController::class,'register']);

});

Route::get('user/{id}',[UserController::class,'show']);
Route::post('users', [UserController::class,'index']);
Route::post('allusers', [UserController::class,'all']);
Route::post('user', [UserController::class,'store']);
Route::put('user', [UserController::class,'store']);
Route::delete('user/{id}', [UserController::class,'destroy']);


Route::get('task{id}',[TaskController::class,'show']);
Route::post('tasks',[TaskController::class,'index']);
Route::post('task',[TaskController::class,'store']);
Route::put('task',[TaskController::class,'store']);
Route::delete('task/{id}',[TaskController::class,'destroy']);
