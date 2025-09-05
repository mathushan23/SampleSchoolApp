<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Admin\ContactAdminController;

// Authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Contact form submission
Route::post('/contact', [ContactController::class, 'store']);

// Admin API routes
Route::prefix('admin')->group(function () {
    Route::get('/contacts', [ContactAdminController::class, 'index']);
    Route::post('/contacts/read/{id}', [ContactAdminController::class, 'markAsRead']);
    Route::get('/contacts/view/{id}', [ContactAdminController::class, 'view']);
});
