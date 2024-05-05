<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SponsorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/login', [AuthController::class, 'indexLogin']);
Route::get('/auth/register', [AuthController::class, 'indexRegister']);
Route::post('/auth/register', [AuthController::class, 'storeRegister']);
Route::post('/auth/login', [AuthController::class, 'login']);


// Event
Route::get('/event/dashboard',[EventController::class, 'index']);



// Sponsor
Route::get('/auth/sponsor',[SponsorController::class,'indexAddSponsor']);
Route::post('/auth/sponsor',[SponsorController::class,'store']);
Route::get('/sponsor/dashboard',[SponsorController::class,'index']);



