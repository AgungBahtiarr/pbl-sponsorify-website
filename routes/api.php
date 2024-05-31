<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\SponsorController;
use App\Http\Controllers\api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


// Sponsors
Route::get('/sponsors',[SponsorController::class,'index']);
Route::get('/sponsor/{id}',[SponsorController::class,'show']);
Route::post('/sponsor/search',[SponsorController::class,'search']);
Route::post('/sponsor',[SponsorController::class,'store']);
Route::post('/sponsor/categories',[SponsorController::class,'indexCategory']);


// Roles
Route::get('/roles',[RoleController::class,'index']);

// Categories
Route::get('/categories',[CategoryController::class, 'index']);

// Event
Route::get('/events',[EventController::class,'index'])->middleware('auth:sanctum');
Route::post('/event',[EventController::class,'store']);


// Transaction
Route::get('/transactions', [TransactionController::class,'index'])->middleware('auth:sanctum');
Route::post('/transaction', [TransactionController::class,'store'])->middleware('auth:sanctum');

