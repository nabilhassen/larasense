<?php

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::view('/', 'home')->name('home')->middleware('guest');

Route::get('home', Livewire\Materials\Index::class)->name('materials.index');

Route::view('terms-and-conditions', 'terms')->name('terms');

Route::view('privacy-policy', 'privacy-policy')->name('privacy');

Route::get('feed/{type}', Livewire\FeedBySourceType::class)
    ->name('feed.type');

Route::post('update-timezone', UpdateUserTimezoneController::class)->name('timezone.update');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('m/{slug}', Livewire\Materials\Show::class)
            ->name('materials.show');

        Route::get('likes', Livewire\Likes::class)
            ->name('likes');

        Route::get('bookmarks', Livewire\Bookmarks::class)
            ->name('bookmarks');

        Route::view('settings', 'profile')
            ->name('settings');

        Route::get('publishers/{slug}', Livewire\Publishers\Show::class)
            ->name('publishers.show');
    });
