const mix = require('laravel-mix');

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

mix.disableNotifications();

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css', { outputStyle: 'compressed' })
  .sass('resources/assets/sass/admin/admin.scss', 'public/css/admin', { outputStyle: 'compressed' });

mix.react('resources/assets/js/admin/Admin.jsx', 'public/js/admin');

mix.copy('resources/assets/images/favicon.ico', 'public/favicon.ico');
mix.copy('resources/assets/images/favicon-16x16.png', 'public/favicon-16x16.png');
mix.copy('resources/assets/images/favicon-32x32.png', 'public/favicon-32x32.png');
mix.copy('resources/assets/images/apple-touch-icon.png', 'public/apple-touch-icon.png');

mix.version();
mix.browserSync('mavin-rocks.test');
