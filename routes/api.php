<?php

Route::post('auth', \App\Http\Controllers\Api\AuthController::class)
    ->name('auth');

Route::prefix('v1')
    ->name('v1.')
    ->middleware('auth:sanctum')
    ->group(base_path('routes/versions/v1.php'));
