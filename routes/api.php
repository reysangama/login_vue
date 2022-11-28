<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Security\ProfileController;

use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('getModules/{id}', [UserController::class, 'getModules']);
<<<<<<< HEAD
=======
Route::get('getSession/', [UserController::class, 'getSession']);
Route::apiResource('profiles', ProfileController::class);
>>>>>>> 80f43c4cc2608a0b11f20da3f9b6bcc7af95f340
Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('add', [BookController::class, 'add']);
    Route::get('edit/{id}', [BookController::class, 'edit']);
    Route::post('update/{id}', [BookController::class, 'update']);
    Route::delete('delete/{id}', [BookController::class, 'delete']);

});