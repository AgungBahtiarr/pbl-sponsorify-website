<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SponsorEventController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\admin\WithdrawController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isEvent;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isSponsor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::get('/auth/login', [AuthController::class, 'indexLogin']);
Route::get('/auth/register', [AuthController::class, 'indexRegister']);
Route::post('/auth/register', [AuthController::class, 'storeRegister']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::delete('/auth/logout',[AuthController::class,'logout']);

Route::middleware([isLogin::class])->group(function (){

    Route::middleware([isEvent::class])->group(function(){
        // Event
        Route::get('/event/dashboard',[EventController::class, 'index']);
        Route::get('/event/my_event',[EventController::class, 'indexMyEvent']);
        Route::post('/event/my_event',[EventController::class, 'storeEvent']);
        Route::get('/event/sponsors',[SponsorController::class, 'indexSearchSponsor']);
        Route::get('/event/sponsor/detail/{id}',[TransactionController::class, 'indexDetail']);
        Route::post('/event/sponsor/detail',[TransactionController::class, 'store']);
        Route::get('/event/status',[StatusController::class, 'index']);
        Route::get('/event/report',[ReportController::class, 'index']);
        Route::get('/event/withdraw',[PaymentController::class,'indexWithdraw']);
        Route::post('event/withdraw',[PaymentController::class,'storeWd']);
        // Report
        Route::post('/event/report',[ReportController::class,'store']);
    });

    Route::middleware([isSponsor::class])->group(function(){
        // Sponsor
        Route::get('/auth/sponsor',[SponsorController::class,'indexAddSponsor']);
        Route::post('/auth/sponsor',[SponsorController::class,'store']);
        Route::get('/sponsor/dashboard',[SponsorController::class,'index']);
        Route::post('/sponsor/categories',[SponsorController::class,'indexSearchSponsor']);
        Route::post('/sponsor/search',[SponsorController::class,'indexSearchSponsor']);
        Route::get('/sponsor/detail/{id}',[SponsorEventController::class,'show']);
        Route::get('/sponsor/event',[SponsorEventController::class,'index']);
        Route::get('/sponsor/history',[HistoryController::class,'index']);
        Route::patch('/sponsor/review', [TransactionController::class,'update']);
        Route::get('/sponsor/payment',[PaymentController::class,'index']);
        Route::post('/sponsor/payNow',[PaymentController::class,'payNow']);
    });


    Route::middleware([isAdmin::class])->group(function(){
        //Admin
        Route::get('/admin/dashboard',[DashboardController::class,'index']);
        Route::get('/admin/payment',[AdminPaymentController::class,'index']);
        Route::post('/admin/payment',[AdminPaymentController::class,'confirmPayment']);
        Route::get('/admin/withdraw',[WithdrawController::class,'index']);
        Route::post('/admin/withdraw',[WithdrawController::class,'confirmWithdraw']);
    });
});










