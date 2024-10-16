<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\SponsorController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\BenefitLevelController;
use App\Models\BenefitLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User
Route::get('/authUser', [UserController::class, 'authUser'])->middleware('auth:sanctum');

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


// Sponsors
Route::get('/sponsors', [SponsorController::class, 'index']);
Route::get('/sponsor/{id}', [SponsorController::class, 'show']);
Route::post('/sponsor/search', [SponsorController::class, 'search']);
Route::post('/sponsor', [SponsorController::class, 'store']);
Route::post('/sponsor/categories', [SponsorController::class, 'indexCategory']);
Route::post('/sponsor/currentSponsor', [SponsorController::class, 'currentSponsor']);
Route::get('/roles', [RoleController::class, 'index']);

// Categories
Route::get('/categories', [CategoryController::class, 'index']);

// Event
Route::get('/event/{id}', [EventController::class, 'show']);
Route::get('/events', [EventController::class, 'index'])->middleware('auth:sanctum');
Route::post('/event', [EventController::class, 'store']);
Route::delete('/event/{id}', [EventController::class, 'destroy']);

// BenefitLevel
Route::post('/benefit-level', [BenefitLevelController::class, 'store']);

// Transaction
Route::get('/transactions', [TransactionController::class, 'index'])->middleware('auth:sanctum');
Route::post('/transaction', [TransactionController::class, 'store'])->middleware('auth:sanctum');
Route::post('/transactions/sponsor', [TransactionController::class, 'indexSponsor']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
Route::patch('/transaction', [TransactionController::class, 'update']);

// Report
Route::get('/reports', [ReportController::class, 'index']);
Route::post('/report', [ReportController::class, 'store']);

//Payment
Route::get('/payments', [PaymentController::class, 'index'])->middleware('auth:sanctum');
Route::post('/payment/payNow', [PaymentController::class, 'payNow']);

//Withdraw
Route::get('/withdraws', [PaymentController::class, 'indexWithdraw'])->middleware('auth:sanctum');
Route::post('/withdraw', [PaymentController::class, 'storeWd']);

//Admin
Route::get('/admin/withdraws', [PaymentController::class, 'indexWithdrawAdmin']);
Route::post('/admin/withdraw', [PaymentController::class, 'confirmWithdrawAdmin']);
Route::get('/admin/payments', [PaymentController::class, 'indexPaymentAdmin']);
Route::post('/admin/payment', [PaymentController::class, 'confirmPaymentAdmin']);
