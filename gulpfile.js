const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// javascript
elixir(function(mix) {
    mix.webpack('app.js');
    mix.scripts('jquery-3.1.1.min.js');
});

// sass-compiled styles
elixir(function(mix) {
    mix.sass('app.scss');
});

// vanilla styles
elixir(function(mix) {
    mix.styles([
        'main.css',
        'bootstrap-fix.css'
    ], 'public/css/styles.css');
});