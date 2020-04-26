<?php

namespace Ryancco\Sessions;

use Illuminate\Support\ServiceProvider;

class SessionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sessions.php', 'sessions');
    }
}
