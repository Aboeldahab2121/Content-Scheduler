<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Posts
    Route::resource('posts', PostController::class)->except(['show', 'edit', 'update']);

    // Platforms
    Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');
    Route::post('/platforms/toggle', [PlatformController::class, 'toggle'])->name('platforms.toggle');

    Route::middleware('auth')->group(function () {
        Route::get('/posts/calendar', [PostController::class, 'calendar'])->name('posts.calendar');
        Route::resource('posts', PostController::class)->except(['show', 'edit', 'update']);
    });
});
