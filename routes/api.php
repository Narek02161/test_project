<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Statement\StatementController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('statements')->group(function () {
        Route::get('/', [StatementController::class, 'index']);
        Route::post('/', [StatementController::class, 'create']);
        Route::patch('/{id}', [StatementController::class, 'update']);
        Route::delete('/{id}', [StatementController::class, 'delete']);
    });
});
