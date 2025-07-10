<?php

declare(strict_types=1);

use App\Data;
use App\Livewire\FeedBySourceType;
use App\Livewire\Materials\Bookmarks;
use App\Livewire\Materials\Index;
use App\Livewire\Materials\Likes;
use App\Livewire\Traits\CanLoadMore;
use App\Livewire\Traits\InteractsWithMaterial;

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

arch('material components uses InteractsWithMaterial trait')
    ->expect('App\Livewire\Materials')
    ->toUseTrait(InteractsWithMaterial::class)
    ->ignoring([
        Bookmarks::class,
        Index::class,
        Likes::class,
    ]);

arch('components uses CanLoadMore trait')
    ->expect([
        Index::class,
        Bookmarks::class,
        FeedBySourceType::class,
        Likes::class,
    ])
    ->toUseTrait(CanLoadMore::class);

arch('material data classes extend base material data class')
    ->expect([
        Data\ArticleMaterialData::class,
        Data\PodcastMaterialData::class,
        Data\YoutubeMaterialData::class,
    ])
    ->toExtend(Data\MaterialData::class);
