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

mix.disableNotifications();

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/vendor.js', 'public/js')
    .js('resources/assets/js/admin/admin.js', 'public/js/admin')
    .js('resources/assets/js/admin/vendor.js', 'public/js/admin')
    .scripts([
        'node_modules/trumbowyg/dist/plugins/base64/trumbowyg.base64.js',
        'node_modules/trumbowyg/dist/plugins/allowtagsfrompaste/trumbowyg.allowtagsfrompaste.js',
        'node_modules/trumbowyg/dist/plugins/history/trumbowyg.history.js',
        'node_modules/trumbowyg/dist/plugins/noembed/trumbowyg.noembed.js',
        'node_modules/trumbowyg/dist/plugins/pasteembed/trumbowyg.pasteembed.js',
        'node_modules/trumbowyg/dist/plugins/preformatted/trumbowyg.preformatted.js',
        'node_modules/trumbowyg/dist/plugins/upload/trumbowyg.upload.js'
    ], 'public/js/admin/trumbowyg.plugins.js')
    .sass('resources/assets/sass/app.scss', 'public/css', {outputStyle: 'compressed'})
    .sass('resources/assets/sass/vendor.scss', 'public/css', {outputStyle: 'compressed'})
    .sass('resources/assets/sass/admin/admin.scss', 'public/css/admin', {outputStyle: 'compressed'})
    .sass('resources/assets/sass/admin/vendor.scss', 'public/css/admin', {outputStyle: 'compressed'});

mix.copy('resources/assets/images/theme/lead.jpg', 'public/images/lead.jpg');
mix.copy('resources/assets/images/favicon.ico', 'public/favicon.ico');
mix.copy('resources/assets/images/favicon-16x16.png', 'public/favicon-16x16.png');
mix.copy('resources/assets/images/favicon-32x32.png', 'public/favicon-32x32.png');
mix.copy('resources/assets/images/apple-touch-icon.png', 'public/apple-touch-icon.png');

mix.version();
mix.browserSync('mavin.test');