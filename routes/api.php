<?php

use App\Http\Controllers\ScheduledOrderController;
use App\Http\Controllers\TgTopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/tg-top/services', [TgTopController::class, 'services']);
Route::get('/tg-top/balances', [TgTopController::class, 'balance']);

Route::post('/orders/schedule', [ScheduledOrderController::class, 'scheduleOrders']);
