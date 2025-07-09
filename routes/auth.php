<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->group(function () {
        Route::get('verify-email', Auth\VerifyEmail::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::get('confirm-password', Auth\ConfirmPassword::class)
            ->name('password.confirm');
    });

Route::middleware('guest')
    ->group(function () {
        Route::get('register', Auth\Register::class)
            ->name('register');

        Route::get('login', Auth\Login::class)
            ->name('login');

        Route::get('forgot-password', Auth\ForgotPassword::class)
            ->name('password.request');

        Route::get('reset-password/{token}', Auth\ResetPassword::class)
            ->name('password.reset');

        Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
            ->name('socialite.redirect');

        Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleCallback'])
            ->name('socialite.callback');
    });
