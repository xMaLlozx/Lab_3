<?php

namespace Tukmachev\Shop;

use Illuminate\Support\ServiceProvider;
use Tukmachev\Shop\Services\CurrencyRateService;
use Tukmachev\Shop\Services\DeliveryCalculatorService;

class ShopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shop.php', 'shop');

        $this->app->singleton('currency-rate', function ($app) {
            return new CurrencyRateService(config('shop.currency'));
        });

        $this->app->singleton('delivery-calculator', function ($app) {
            return new DeliveryCalculatorService(config('shop.delivery'));
        });
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'shop');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/shop.php' => config_path('shop.php'),
            ], 'shop-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/shop'),
            ], 'shop-views');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'shop-migrations');

            $this->publishes([
                __DIR__ . '/../database/seeders' => database_path('seeders'),
            ], 'shop-seeders');
        }
    }
}
