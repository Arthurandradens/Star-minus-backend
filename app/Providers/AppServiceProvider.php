<?php

namespace App\Providers;

use App\Repository\WatchListRepository;
use App\Service\WatchListService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository
        $this->app->singleton(WatchListRepository::class, function ($app) {
            return new WatchListRepository();
        });

        // Services
        $this->app->singleton(WatchListService::class, function ($app) {
            return new WatchListService($app->make(WatchListRepository::class));
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
