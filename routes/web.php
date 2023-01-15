<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)-> name('home');

Route::get('/posts/{post}', [PostController::class, 'show'])-> name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/explore', [ExploreController::class, 'index'])-> name('explore.index');

Route::get('/users/{user:username}/profile', [UserProfileController::class, 'index'])-> name('users.profile');

Route::post('/users/{user:username}/follows', [UserFollowController::class, 'store'])-> name('users.follows.store');
Route::delete('/users/{user:username}/follows/{follow}', [UserFollowController::class, 'destroy'])-> name('users.follows.destroy');

Route::post('/logout', [LogoutController::class, 'store'])-> name('logout');

Route::get('/login', [LoginController::class, 'index'])-> name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])-> name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])-> name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])-> name('posts.likes');
