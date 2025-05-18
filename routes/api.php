<?php

use App\Http\Controllers\Api\JadwalDokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

// sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/jadwal-dokter', [JadwalDokterController::class, 'index']);
    Route::post('/jadwal-dokter', [JadwalDokterController::class, 'store']);
});