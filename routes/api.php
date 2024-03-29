<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\PasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::post('/password/reset', [PasswordController::class, 'reset'])->middleware('auth:sanctum');
    Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
});
