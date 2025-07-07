<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider, and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['session.exists', 'account.exists'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tests', [TestController::class, 'index'])->name('tests.index');
    Route::get('/tests/upload', [TestController::class, 'showUploadForm']);
    Route::post('/tests/upload', [TestController::class, 'store']);
    Route::get('/tests/edit/{id}', [TestController::class, 'showEditForm']);
    Route::post('/tests/edit', [TestController::class, 'update']);

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'showCreateForm']);
    Route::post('/patients/create', [PatientController::class, 'store']);
    Route::get('/patients/edit/{id}', [PatientController::class, 'showEditForm']);
    Route::post('/patients/edit', [PatientController::class, 'update']);
    Route::get('/patients/delete/{id}', [PatientController::class, 'delete']);

    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staffs/create', [StaffController::class, 'showCreateForm']);
    Route::post('/staffs/create', [StaffController::class, 'store']);
    Route::get('/staffs/edit/{id}', [StaffController::class, 'showEditForm']);
    Route::post('/staffs/edit', [StaffController::class, 'update']);
    Route::get('/staffs/delete/{id}', [StaffController::class, 'delete']);

    Route::get('/tests/view/{id}', [TestController::class, 'view']);
    Route::get('/tests/download/{id}', [TestController::class, 'download']);
    Route::get('/tests/delete/{id}', [TestController::class, 'delete']);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update']);
});

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'auth']);
