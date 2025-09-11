<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Endpoint publik untuk login
Route::post('/login', [AuthController::class, 'login']);

// Endpoint publik untuk mengambil data proyek
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);

// Grup endpoint yang dilindungi
Route::middleware('auth:sanctum')->group(function () {
    // Route untuk mendapatkan data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- User Management ---
    Route::get('/users', [UserController::class, 'index'])->middleware('can:is-admin'); // Hanya admin bisa lihat
    Route::post('/users', [UserController::class, 'store'])->middleware('can:is-admin');
    Route::post('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->middleware('can:is-admin'); // Hanya admin bisa blokir/aktifkan
    Route::put('/users/{user}', [UserController::class, 'update'])->middleware('can:is-admin');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('can:is-admin');

    // --- Project Management ---
    // Route::get('/projects', [ProjectController::class, 'index']); // <-- SUDAH DIPINDAH KELUAR
    Route::post('/projects', [ProjectController::class, 'store'])->middleware('can:is-admin'); // Hanya admin bisa buat
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->middleware('can:is-admin');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->middleware('can:is-admin');

    // --- Article Management ---
    Route::apiResource('articles', ArticleController::class)->middleware('can:is-admin');
});
