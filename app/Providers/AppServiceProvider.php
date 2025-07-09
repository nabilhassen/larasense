<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Model::preventLazyLoading(! $this->app->isProduction());

        Carbon::macro('inUserTimezone', function () {
            return $this->timezone(auth()->user()->timezone ?? config('app.timezone'));
        });

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });

        DB::prohibitDestructiveCommands($this->app->isProduction());
    }
}
