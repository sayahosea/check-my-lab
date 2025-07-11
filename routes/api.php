<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
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

// Яке призначення цього?
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['session.exists', 'account.exists'])->group(function () {
    Route::get('/test/fetch', [TestController::class, 'fetch']);

    Route::get('/account/fetch', [AccountController::class, 'fetch']);

    Route::get('/patients/fetch', [PatientController::class, 'fetch']);
    Route::get('/patients/verify', [PatientController::class, 'verify']);
});
