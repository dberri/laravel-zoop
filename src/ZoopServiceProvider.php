<?php

namespace DBerri\LaravelZoop;

use Illuminate\Support\ServiceProvider;

class ZoopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/zoop.php' => config_path('zoop.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/zoop.php',
            'zoop'
        );
    }
}
