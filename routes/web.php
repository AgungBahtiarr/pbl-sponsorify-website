<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/login', [AuthController::class, 'indexLogin']);
Route::get('/auth/register', [AuthController::class, 'indexRegister']);
Route::post('/auth/register', [AuthController::class, 'storeRegister']);
Route::post('/auth/login', [AuthController::class, 'login']);



// Route::get('/auth/login', [AuthController::class, 'index']);
