<?php

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', Livewire\Home::class)->name('home')->middleware('guest');

Route::get('home', Livewire\Materials\Index::class)->name('materials.index');

Route::get('terms-and-conditions', Livewire\Legal\Terms::class)->name('terms');

Route::get('privacy-policy', Livewire\Legal\PrivacyPolicy::class)->name('privacy');

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
