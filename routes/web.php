<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login_post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register_post');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// blog routes
Route::middleware('auth')->group(function () {
    Route::get('/blog/create', [BlogController::class, 'blog_form'])->name('blog_form');
    Route::post('/blog/create', [BlogController::class, 'blog_post'])->name('blog_post');
    Route::get('/blogs', [BlogController::class, 'all'])->name('all_blogs');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('edit_blog');
    Route::put('/blog/{id}/update', [BlogController::class, 'update'])->name('update_blog');
    Route::delete('/blog/{id}/delete', [BlogController::class, 'delete'])->name('delete_blog');
});
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('show_blog');


// category routes
Route::middleware('auth')->group(function () {
    Route::get('/category/create', [CategoryController::class, 'create'])->name('create_category');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('store_category');
    Route::get('/categories', [CategoryController::class, 'all'])->name('all_categories');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('edit_category');
    Route::post('/category/{id}/edit', [CategoryController::class, 'update'])->name('update_category');
    Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('delete_category');
});

Route::get('/categories/{id}', [CategoryController::class, 'blogs_with_category'])->name('blogs_with_category');
Route::get('/tag/{name}', [TagController::class, 'blogs_with_tag'])->name('blogs_with_tag');
