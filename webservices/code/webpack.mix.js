let mix = require('laravel-mix');




/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/cus.js'
], 'public/js');


mix.styles([
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/font-awesome.min.css',
    'resources/assets/css/cus.css'


],'public/css/style.css');



