<?php

namespace Ryancco\Sessions;

use Illuminate\Support\ServiceProvider;

class SessionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/sessions.php' => config_path('sessions.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sessions.php', 'sessions');
    }
}
