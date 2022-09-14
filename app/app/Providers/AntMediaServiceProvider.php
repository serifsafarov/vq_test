<?php

namespace App\Providers;

use App\Services\AntMediaService;
use Illuminate\Support\ServiceProvider;

class AntMediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AntMediaService::class, function ($app) {
            return new AntMediaService(
                config('services.ant_media.api_endpoint'),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
