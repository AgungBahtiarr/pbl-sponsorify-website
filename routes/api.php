<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\SponsorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


// Sponsors
Route::post('/sponsor',[SponsorController::class,'store']);

// Roles
Route::get('/roles',[RoleController::class,'index']);

// Categories
Route::get('/categories',[CategoryController::class, 'index']);

// Event
Route::get('/events',[EventController::class,'index'])->middleware('auth:sanctum');
Route::post('/event',[EventController::class,'store']);
