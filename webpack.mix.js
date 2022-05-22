const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.js([
    'resources/js/app.js',
    'resources/js/script.js',
],'public/js/main.js');

mix.styles([
    'resources/css/bootstraprtl-v4.css',
    'resources/css/style.css',
], 'public/css/main.css');

mix.copyDirectory('resources/fonts','public/fonts')
mix.copyDirectory('resources/img','public/img')
