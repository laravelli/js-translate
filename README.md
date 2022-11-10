# Installation

1. Install package
```bash
composer require laravelli/js-translate
```

2. Install lodash
```bash
npm install lodash --save-dev
```

3. Publish assets
```
php artisan vendor:publish --provider="Laravelli\JsTranslate\JsTranslateServiceProvider" --tag="assets"
```

4. Add in bootstrap.js
```js
// translations
import translate from '@shared/Helpers/translations'
window.translate = window.trans = window.__ = translate
```

5. Add global mixin in app.js
```js
App.mixin({
    methods: {
        __: window.__
    }
})
```

7. Add translations into layout file
```js
<script src="{{ route('js.translations') }}"></script>
```
