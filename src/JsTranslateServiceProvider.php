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
  }
}