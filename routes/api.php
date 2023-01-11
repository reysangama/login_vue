<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\Security\ProfileController;

use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('getModules/', [UserController::class, 'getModules']);
Route::get('search/profiles/{query}',[ProfileController::class, 'search'] );
// Route::get('search/profiles/{field}/{query}',[ProfileController::class, 'search'] );
Route::get('getModules/{id}', [UserController::class, 'getModules']);
Route::get('getSession/', [UserController::class, 'getSession']);
Route::get('profiles/edit/{id}', [ProfileController::class, 'edit']);
Route::apiResource('profiles', ProfileController::class);

Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('add', [BookController::class, 'add']);
    Route::get('edit/{id}', [BookController::class, 'edit']);
    Route::post('update/{id}', [BookController::class, 'update']);
    Route::delete('delete/{id}', [BookController::class, 'delete']);

});