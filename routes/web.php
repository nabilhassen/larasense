<?php

use App\Livewire as Livewire;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/terms-and-conditions', Livewire\Terms::class)->name('terms');
Route::get('/privacy-policy', Livewire\PrivacyPolicy::class)->name('privacy');
