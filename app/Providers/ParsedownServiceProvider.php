<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ParsedownServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(\Parsedown::class, function ($app) {
            return \ParsedownExtra::instance();
        });
    }

    public function provides()
    {
        return [\ParsedownExtra::class];
    }
}