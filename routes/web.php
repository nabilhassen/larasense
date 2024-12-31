<?php

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::post('update-timezone', UpdateUserTimezoneController::class)
    ->name('timezone.update');

Route::domain('app.larasense.test')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('dashboard', Livewire\Dashboard::class)
            ->name('dashboard');

        Route::get('likes', Livewire\Materials\Likes::class)
            ->name('likes');

        Route::get('bookmarks', Livewire\Materials\Bookmarks::class)
            ->name('bookmarks');

        Route::view('settings', 'profile')
            ->name('settings');
    });

Route::domain(config('app.url'))->group(function () {
    Route::get('/', Livewire\Home::class)->name('home');
    Route::get('terms-and-conditions', Livewire\Legal\Terms::class)->name('terms');
    Route::get('privacy-policy', Livewire\Legal\PrivacyPolicy::class)->name('privacy');
});
