<?php

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', Livewire\Home::class)->name('home')->middleware('guest');

Route::get('feed', Livewire\Materials\Index::class)->name('feed')->middleware('guest');

Route::get('terms-and-conditions', Livewire\Legal\Terms::class)->name('terms');

Route::get('privacy-policy', Livewire\Legal\PrivacyPolicy::class)->name('privacy');

Route::post('update-timezone', UpdateUserTimezoneController::class)->name('timezone.update');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('home', Livewire\Materials\Index::class)
            ->name('dashboard');

        Route::get('likes', Livewire\Materials\Likes::class)
            ->name('likes');

        Route::get('bookmarks', Livewire\Materials\Bookmarks::class)
            ->name('bookmarks');

        Route::view('settings', 'profile')
            ->name('settings');
    });

// TEMP Solution for this error: "the server returned a "405 Method Not Allowed".
Route::get('livewire/update', fn() => null);
