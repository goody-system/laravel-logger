<?php

namespace GoodyTech\LaravelLogger\Provider;

use GoodyTech\LaravelLogger\WebRequestLogger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppProvider extends ServiceProvider {
    public function __construct($app) {
        Log::debug('GoodyTech\LaravelLogger\Provider.Call');
        parent::__construct($app);
    }

    function boot() {
        Log::debug('GoodyTech\LaravelLogger\Provider.Call.boot');

    }

    function register(): void {
        Log::debug('GoodyTech\LaravelLogger\Provider.Call.register');

        $this->app->booted(function () {
            Route::prependMiddlewareToGroup('web', WebRequestLogger::class);
        });

    }

}