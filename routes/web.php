<?php

declare(strict_types=1);

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::view('/', 'home')->name('home')->middleware('guest');

Route::livewire('home', Livewire\Materials\Index::class)->name('materials.index');

Route::view('terms-and-conditions', 'terms')->name('terms');

Route::view('privacy-policy', 'privacy-policy')->name('privacy');

Route::livewire('feed/{type}', Livewire\FeedBySourceType::class)
    ->name('feed.type');

Route::post('update-timezone', UpdateUserTimezoneController::class)->name('timezone.update');

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::livewire('m/{slug}', Livewire\Materials\Show::class)
            ->name('materials.show');

        Route::livewire('likes', Livewire\Materials\Likes::class)
            ->name('likes');

        Route::livewire('bookmarks', Livewire\Materials\Bookmarks::class)
            ->name('bookmarks');

        Route::view('settings', 'profile')
            ->name('settings');

        Route::livewire('publishers/{slug}', Livewire\Publishers\Show::class)
            ->name('publishers.show');
    });
