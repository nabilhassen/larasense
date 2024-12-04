<?php

use App\Livewire as Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', Livewire\Home::class)->name('home');
Route::get('/terms-and-conditions', Livewire\Terms::class)->name('terms');
Route::get('/privacy-policy', Livewire\PrivacyPolicy::class)->name('privacy');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
