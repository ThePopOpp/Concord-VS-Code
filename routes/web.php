<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;

Route::get('hello-world', function () {
    return 'Hello World!';
})->middleware('auth');

    /*
    |--------------------------------------------------------------------------
    | Twilio SMS Routes
    |--------------------------------------------------------------------------
    |
    | Twilio SMS Routes code goes here.
    |
    */

Route::get('/sms', [SmsController::class, 'index'])->name('sms.index');
Route::post('/sms/send', [SmsController::class, 'send'])->name('sms.send');
Route::post('/sms/send-bulk', [SmsController::class, 'sendBulk'])->name('sms.sendBulk');
