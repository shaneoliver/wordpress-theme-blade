const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your theme. Compile the Sass for your front-end and editor
| css. Optionally compile JS here if you are using ES2016+ or web components
|
*/
mix.setPublicPath('dist')
    .sourceMaps()
    .disableNotifications()
    .options({
        processCssUrls: false,
    })
    .sass('src/sass/shaneoliver.scss', 'css')
    .js('src/js/shaneoliver.js', 'js')
    .copy('node_modules/lightcase/src/fonts/', 'dist/fonts')
    .copy('node_modules/lightcase/src/js/lightcase.js', 'dist/js/lightcase.js')

    // Copy FontAwesome Pro to assets directory
    .copy('node_modules/@fortawesome/fontawesome-pro/webfonts/', 'dist/webfonts')
    .copy('node_modules/@fortawesome/fontawesome-pro/css/all.min.css', 'dist/css/fontawesome-all.min.css')

    .browserSync({
        proxy: 'http://blade.test',
        files: [
            './dist/css/*.css',
            './dist/js/*.js',
            '**/*.php',
            './views/**/*.blade.php'
        ],
        notify: false,
    });