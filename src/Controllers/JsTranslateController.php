<?php

namespace Laravelli\JsTranslate\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class JsTranslateController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke()
    {
        $lang = config('app.locale');

        $files = [
            base_path("lang/{$lang}/validation.php"),
            base_path("lang/{$lang}.json"),
        ];

        $strings = Cache::remember(
            "lang_{$lang}.js",
            now()->addSeconds(1),
            function () use ($lang, $files) {
                $strings = [];
                foreach ($files as $file) {
                    if (Str::endsWith($file, '.json')) {
                        if (file_exists($file)) {
                            $name = '__global';
                            $content = json_decode(file_get_contents($file));
                        }
                    } else {
                        if (file_exists($file)) {
                            $name = basename($file, '.php');
                            $content = require $file;
                        }
                    }

                    if (isset($name)) {
                        $strings[$name] = $content;
                        unset($name);
                    }

                    if (! empty($strings)) {
                        $strings['__possible_keys'] = array_keys($strings);
                    }
                }

                return $strings;
            });

        $encoded = json_encode($strings, JSON_THROW_ON_ERROR | JSON_UNESCAPED_LINE_TERMINATORS
          | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);

        $content = 'window.i18n = '.$encoded.';';

        return response($content)->header('Content-Type', 'text/javascript');
    }
}
