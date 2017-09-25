<?php

namespace BOAIdeas\Shopify;

use Illuminate\Support\ServiceProvider;
use RocketCode\Shopify\API;

class ShopifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/shopify.php' => config_path('shopify.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/shopify.php', 'shopify'
        );

        $this->app->singleton(API::class, function ($app) {
            return new API([
                'API_KEY'       => config('shopify.api_key'),
                'API_SECRET'    => config('shopify.api_secret'),
                'SHOP_DOMAIN'   => config('shopify.shop_domain'),
                'ACCESS_TOKEN'  => config('shopify.access_token'),
            ]);
        });
    }
}
