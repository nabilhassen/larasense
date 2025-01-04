<?php

arch()
    ->preset()
    ->laravel()
    ->ignoring([
        'App\Providers\Filament\AdminPanelProvider',
        'App\Http\Controllers\Auth\SocialiteController',
    ]);

arch()
    ->preset()
    ->security();

arch()
    ->preset()
    ->php();
