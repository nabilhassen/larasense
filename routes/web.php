<?php

use App\Livewire\Home;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/terms-and-conditions', Terms::class)->name('terms');
