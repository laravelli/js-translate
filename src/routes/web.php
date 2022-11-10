<?php

use \Laravelli\JsTranslate\Controllers\JsTranslateController;
use Illuminate\Support\Facades\Route;

Route::get('js/translations.js', JsTranslateController::class)->name('js.translations');
