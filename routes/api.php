<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\SponsorController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User
Route::get('/authUser',[UserController::class,'authUser'])->middleware('auth:sanctum');

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


// Sponsors
Route::get('/sponsors',[SponsorController::class,'index']);
Route::get('/sponsor/{id}',[SponsorController::class,'show']);
Route::post('/sponsor/search',[SponsorController::class,'search']);
Route::post('/sponsor',[SponsorController::class,'store']);
Route::post('/sponsor/categories',[SponsorController::class,'indexCategory']);
Route::post('/sponsor/currentSponsor',[SponsorController::class,'currentSponsor']);
Route::get('/roles',[RoleController::class,'index']);

// Categories
Route::get('/categories',[CategoryController::class, 'index']);

// Event
Route::get('/event/{id}',[EventController::class,'show']);
Route::get('/events',[EventController::class,'index'])->middleware('auth:sanctum');
Route::post('/event',[EventController::class,'store']);

// Transaction
Route::get('/transactions', [TransactionController::class,'index'])->middleware('auth:sanctum');
Route::post('/transaction', [TransactionController::class,'store'])->middleware('auth:sanctum');
Route::post('/transactions/sponsor', [TransactionController::class,'indexSponsor']);
Route::get('/transaction/{id}',[TransactionController::class,'show']);
Route::patch('/transaction', [TransactionController::class,'update']);

// Report
Route::get('/reports',[ReportController::class,'index']);
Route::post('/report',[ReportController::class,'store']);

