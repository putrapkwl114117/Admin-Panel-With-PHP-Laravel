<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;


//routs unutk halaman home
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'searchRedirect'])->name('search');

// Route untuk menampilkan detail postingan
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Rute untuk mengarahkan root URL ke halaman login
Route::get('/', function () {
    return redirect()->route('login'); 
});

// Halaman Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Halaman Admin Panel (dilindungi oleh middleware auth)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', function () {
        $users = User::all(); 
        return view('admin', compact('users')); 
    })->name('admin.panel');

    // Rute lainnya untuk admin
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

    // Rute untuk menampilkan form edit pengguna
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    //routs untuk menghapus penggunna
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
// Rute untuk pencarian pengguna
    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');

    // admin_post untuk semua routs
    Route::get('/admin/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/posts/search', [PostController::class, 'searchPosts'])->name('admin.posts.search');

});