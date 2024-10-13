<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Autentikasi (Login & Register)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Melihat daftar dan detail postingan (Admin dan User)
Route::get('/posts', [HomeController::class, 'index']);
Route::get('/posts/{id}', [HomeController::class, 'searchRedirect']);

// Rute yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {

    // // Hanya Admin yang bisa menambah, mengedit, dan menghapus postingan
    Route::middleware('can:create,App\Models\Post')->post('/posts', [PostController::class, 'store']);
    // Route::middleware('can:update,post')->put('/posts/{id}', [PostController::class, 'update']);
    Route::middleware('can:delete,post')->delete('/posts/{id}', [PostController::class, 'destroy']);
    
    // Admin-specific routes (memerlukan admin middleware)
    Route::middleware('admin')->group(function () {
          // CRUD untuk user (khusus admin)
        Route::middleware('admin')->get('/admin/users', [UserController::class, 'index']);
        Route::post('/admin/users', [UserController::class, 'store']);
        Route::put('/admin/users/{id}', [UserController::class, 'update']);
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
        Route::get('/admin/users/search', [UserController::class, 'search']);
        Route::get('/admin/users/{id}', [UserController::class, 'show']);
   
        // Admin juga bisa melihat daftar dan detail postingan
        Route::get('/admin/posts', [PostController::class,  'index']);
        Route::put('/admin/posts/{id}', [PostController::class, 'update']);
        Route::get('/admin/posts/{id}', [PostController::class, 'searchPosts']);
        Route::delete('/admin/posts/{id}', [PostController::class, 'destroy']);
    });
});