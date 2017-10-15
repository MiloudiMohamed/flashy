<?php

namespace Devmi\Flashy;

use Illuminate\Support\ServiceProvider;

class FlashyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/config/flashy.php' => config_path('flashy.php'),
        ]);
        $this->publishes([
            __DIR__ . '/Views' => resource_path('assets/js/vendor/devmi')
        ], 'devmi');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flashy', function () {
            return $this->app->make('Devmi\Flashy\Flashy');
        });
    }
}
