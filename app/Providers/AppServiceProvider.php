<?php

namespace App\Providers;

use App\Repository\MovieRepository;
use App\Service\MovieService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository
        $this->app->singleton(MovieRepository::class, function ($app) {
            return new MovieRepository();
        });

        // Services
        $this->app->singleton(MovieService::class, function ($app) {
            return new MovieService($app->make(MovieRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
