<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/twilio/webhook', [CallController::class, 'handleWebhook'])->name('twilio.webhook');
Route::post('/call', [CallController::class, 'initiateCall']);
Route::get('/repeat-recording', [CallController::class, 'repeatRecording']);
