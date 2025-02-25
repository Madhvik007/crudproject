<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Public Homepage
Route::get('/', function () {
    return view('welcome');
});

// Public View for Single Blog Post
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// User Dashboard (Only Authenticated Users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (Only Admins Can Manage Blog Posts)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    
    // Blog Post Management
    Route::get('/admin/posts', [PostController::class, 'adminIndex'])->name('admin.posts');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/posts/save', [PostController::class, 'store'])->name('admin.posts.save');
    Route::get('/admin/posts/edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/update/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/delete/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete');
    Route::get('/admin/posts/{id}', [PostController::class, 'adminShow'])->name('admin.posts.show');

});

require __DIR__.'/auth.php';
