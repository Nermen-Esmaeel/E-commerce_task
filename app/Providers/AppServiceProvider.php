<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\CartService::class, function ($app) {
            return new \App\Services\CartService(
                $app->make(\App\Models\Product::class)
            );
        });

        $this->app->bind(\App\Services\OrderService::class, function ($app) {
            return new \App\Services\OrderService(
                $app->make(\App\Models\Order::class)
            );
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
