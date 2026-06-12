<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\SearchServiceContract;
use App\Services\SearchService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SearchServiceContract::class,
            SearchService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}