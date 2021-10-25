<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use gl\otp\Http\Controllers\OtpController;

Route::get('otp',function(){
    return 'Hello';
});

//Api Routes
Route::post('/sendOtp',[OtpController::class, 'sendOtp'])->name('api.sendOtp');
Route::post('/resendOtp/{phone}',[OtpController::class, 'resendOtp'])->name('api.resendOtp');
Route::post('/verifyOtp',[OtpController::class, 'verifyOtp'])->name('api.verifyOtp');

//Web Routes
Route::get('/otp',[OtpController::class, 'index'])->name('otp');
Route::post('/sendOtp',[OtpController::class, 'webSendOtp'])->name('web.sendOtp');
Route::post('/resendOtp',[OtpController::class, 'webResendOtp'])->name('web.resendOtp');
Route::post('/verifyOtp',[OtpController::class, 'webVerifyOtp'])->name('web.verifyOtp');