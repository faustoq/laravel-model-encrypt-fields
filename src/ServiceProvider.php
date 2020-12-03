<?php

namespace ModelEncryptFields;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap package services.
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/encrypt-fields.php' => config_path('encrypt-fields.php')]);
    }
    
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/encrypt-fields.php', 'encrypt-fields');
    }
}
