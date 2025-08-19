<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicVendorController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    // Vendors
    Route::get('/vendors', [PublicVendorController::class, 'getVendors']);
    Route::post('/vendors', [PublicVendorController::class, 'createVendor']);
    Route::put('/vendors/{id}', [PublicVendorController::class, 'updateVendor']);
    Route::delete('/vendors/{id}', [PublicVendorController::class, 'deleteVendor']);

    // Contracts
    Route::get('/contracts', [ContractController::class, 'index']);
    Route::post('/contracts', [ContractController::class, 'store']);
    Route::put('/contracts/{id}', [ContractController::class, 'update']);
    Route::delete('/contracts/{id}', [ContractController::class, 'delete']);

    // KPIs
    Route::get('/kpis', [KpiController::class, 'index']);
    Route::post('/kpis', [KpiController::class, 'store']);
    Route::put('/kpis/{id}', [KpiController::class, 'update']);
    Route::delete('/kpis/{id}', [KpiController::class, 'delete']);

    // Certifications
    Route::get('/certifications', [CertificationController::class, 'index']);
    Route::post('/certifications', [CertificationController::class, 'store']);
    Route::put('/certifications/{id}', [CertificationController::class, 'update']);
    Route::delete('/certifications/{id}', [CertificationController::class, 'delete']);

    // Messages
    Route::get('/messages', [MessageController::class, 'getMessage']);
    Route::post('/messages', [MessageController::class, 'updateMessage']);
    Route::delete('/messages/{id}', [MessageController::class, 'deleteMessage']);
});
