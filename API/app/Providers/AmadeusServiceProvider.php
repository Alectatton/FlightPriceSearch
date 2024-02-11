<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AmadeusService;

class AmadeusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AmadeusService::class, function ($app) {
            return new AmadeusService();
        });
    }
}