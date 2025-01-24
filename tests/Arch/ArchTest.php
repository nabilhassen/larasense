<?php

use App\Livewire\Materials\Bookmarks;
use App\Livewire\Materials\Card;
use App\Livewire\Materials\Index;
use App\Livewire\Materials\Likes;
use App\Livewire\Materials\Modal;
use App\Livewire\Materials\Show;
use App\Livewire\Traits\CanLoadMore;
use App\Livewire\Traits\HasEngagementMetrics;

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

arch('material components uses HasEngagementMetrics trait')
    ->expect('App\Livewire\Materials')
    ->toUseTrait(HasEngagementMetrics::class)
    ->ignoring([
        Bookmarks::class,
        Index::class,
        Likes::class,
    ]);

arch('material components uses CanLoadMore trait')
    ->expect('App\Livewire\Materials')
    ->toUseTrait(CanLoadMore::class)
    ->ignoring([
        Card::class,
        Modal::class,
        Show::class,
    ]);
