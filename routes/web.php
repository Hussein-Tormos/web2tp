<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;


Route::get('/sign', [UserController::class, 'create'])->name('signup.form');

Route::get('/', [AuthController::class, 'signin'])->name('signin.form');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/signin', [AuthController::class, 'dosignin'])->name('dosignin');

Route::post('/signup', [UserController::class, 'store'])->name('signup.store');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/movies/{movie}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


Route::middleware(['CheckAuth', 'CheckAdmin'])->group(function () {

    Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('movies.create');

    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    Route::get('/admin/movies', [MovieController::class, 'adminIndex'])->name('admin.index');

    Route::get('/admin/movies/{movie}', [MovieController::class, 'adminshow'])->name('admin.show');

    Route::get('/admin/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.update');

    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.edit');

    Route::delete('/admin/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
