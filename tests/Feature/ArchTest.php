<?php

use App\Livewire\Bookmarks;
use App\Livewire\FeedBySourceType;
use App\Livewire\Likes;
use App\Livewire\Materials\Index;
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
        Index::class,
    ]);

arch('components uses CanLoadMore trait')
    ->expect([
        Index::class,
        Bookmarks::class,
        FeedBySourceType::class,
        Likes::class,
    ])
    ->toUseTrait(CanLoadMore::class);
