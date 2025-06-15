<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MidtransCallbackController;

Route::post('payment/callback', [MidtransCallbackController::class, 'handleCallback'])->name('payment.callback');

Route::get('/test-route', function () {
    return response()->json(['message' => 'Test route OK']);
});
