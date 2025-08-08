<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rules\Password;

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
        Carbon::macro('inUserTimezone', function () {
            return $this->timezone(auth()->user()->timezone ?? config('app.timezone'));
        });

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });

        $this->configureVite();

        $this->configureModels();

        $this->configureTests();

        $this->configureHttps();

        $this->configureDates();

        $this->configureCommands();

        $this->configurePasswordValidation();
    }

    protected function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    protected function configureModels(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Model::shouldBeStrict();

        Model::unguard();
    }

    protected function configureTests(): void
    {
        Sleep::fake();
    }

    protected function configureHttps(): void
    {
        URL::forceHttps(app()->isProduction());
    }

    protected function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    protected function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );
    }

    protected function configurePasswordValidation(): void
    {
        Password::defaults(fn (): ?Password => app()->isProduction() ? Password::min(12)->max(255)->uncompromised() : null);
    }
}
