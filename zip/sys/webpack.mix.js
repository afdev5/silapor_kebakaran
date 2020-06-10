let mix = require('laravel-mix');
mix.webpackConfig({ resolve: { symlinks: false } });

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

mix.styles([
	'../assets/modules/bootstrap/css/bootstrap.css',
	'../assets/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css',
	'../assets/modules/summernote/summernote-lite.css',
   '../assets/modules/flag-icon-css/css/flag-icon.min.css',
   '../assets/css/demo.css',
   '../assets/css/style.css',
   '../assets/magnific-popup/magnific-popup.css'
], 
'public/css/app.css').version();


mix.scripts([
	'../assets/modules/jquery.min.js',
	'../assets/modules/popper.js',
	'../assets/modules/tooltip.js',
   '../assets/modules/bootstrap/js/bootstrap.js',
   '../assets/modules/nicescroll/jquery.nicescroll.min.js',
   '../assets/modules/scroll-up-bar/dist/scroll-up-bar.min.js',
   '../assets/js/sa-functions.js',
   '../assets/modules/chart.min.js',
   '../assets/modules/summernote/summernote-lite.js',
   '../assets/js/scripts.js',
   '../assets/js/custom.js'
], 
'public/js/app.js').version();
