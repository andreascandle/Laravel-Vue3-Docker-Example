<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;
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
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Route::get('/', [BookController::class, 'index']);
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'listUser']);
        Route::get('/edit/{id}', [UserController::class, 'getUser']);
        Route::post('/update/{id}', [UserController::class, 'updateUser']);
    });
    // Route::post('add', [BookController::class, 'add']);
    // Route::get('edit/{id}', [BookController::class, 'edit']);
    // Route::post('update/{id}', [BookController::class, 'update']);
    // Route::delete('delete/{id}', [BookController::class, 'delete']);
});