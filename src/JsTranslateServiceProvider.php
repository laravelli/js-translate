<?php

namespace Laravelli\JsTranslate;

use Illuminate\Support\ServiceProvider;

class JsTranslateServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // publish assets
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/js/translations.js' => resource_path('modules/shared/Helpers/translations.js'),
            ], 'assets');

        }
    }
}
