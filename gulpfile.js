var elixir = require('laravel-elixir');

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
var bootstrap_sass = './node_modules/bootstrap-sass/';
elixir(function(mix) {
    //vendor script
    mix.scripts([
        'jquery/dist/jquery.js',
        'popper.js/dist/umd/popper.js',
        'bootstrap/dist/js/bootstrap.js',
        'select2/dist/js/select2.js',
        'datatables/media/js/jquery.dataTables.js',

    ], 'public/js/vendor.js', 'node_modules');

    // app script
    mix.scripts('assets/js/*.js', 'public/js/app.js', 'resources');

    // vendor css
    mix.styles([
        'bootstrap/dist/css/bootstrap.min.css',
        'font-awesome/css/font-awesome.min.css',
        'select2/dist/css/select2.css',
        'select2-bootstrap-theme/dist/select2-bootstrap.css',
        'datatables/media/css/jquery.dataTables.css',

    ], 'public/css/vendor.css', 'node_modules');

    //app css
    mix.styles('assets/css/**/*.css', 'public/css/app.css', 'resources');

    //copy font to public
    mix.copy("./node_modules/bootstrap-sass/assets/fonts/bootstrap",'public/fonts');
    mix.copy("./node_modules/font-awesome/fonts",'public/fonts');

    //copy image to public
    mix.copy("./node_modules/datatables/media/images",'public/images');
    
});
