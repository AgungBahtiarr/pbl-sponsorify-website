<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\SponsorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/auth/login');
});


Route::get('/auth/login', [AuthController::class, 'indexLogin']);
Route::get('/auth/register', [AuthController::class, 'indexRegister']);
Route::post('/auth/register', [AuthController::class, 'storeRegister']);
Route::post('/auth/login', [AuthController::class, 'login']);


// Event
Route::get('/event/dashboard',[EventController::class, 'index']);
Route::get('/event/my_event',[EventController::class, 'indexMyEvent']);
Route::post('/event/my_event',[EventController::class, 'storeEvent']);
Route::get('/event/sponsors',[SponsorController::class, 'indexSearchSponsor']);
Route::get('/event/sponsor/detail/{id}',[TransactionController::class, 'indexDetail']);
Route::post('/event/sponsor/detail',[TransactionController::class, 'store']);




// Sponsor
Route::get('/auth/sponsor',[SponsorController::class,'indexAddSponsor']);
Route::post('/auth/sponsor',[SponsorController::class,'store']);
Route::get('/sponsor/dashboard',[SponsorController::class,'index']);
Route::post('/sponsor/categories',[SponsorController::class,'indexSearchSponsor']);
Route::post('/sponsor/search',[SponsorController::class,'indexSearchSponsor']);






