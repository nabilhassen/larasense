<?php

use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::post('update-timezone', UpdateUserTimezoneController::class)
    ->name('timezone.update');

Route::domain('app.larasense.test')->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

Route::domain(config('app.url'))->group(function () {
    Route::get('/', Livewire\Home::class)->name('home');
    Route::get('terms-and-conditions', Livewire\Legal\Terms::class)->name('terms');
    Route::get('privacy-policy', Livewire\Legal\PrivacyPolicy::class)->name('privacy');
});
