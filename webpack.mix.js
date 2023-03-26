const mix = require('laravel-mix');
let productionSourceMaps = true;

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

mix.webpackConfig({
  output: {
    chunkFilename: 'assets/js/[name].min.js',
    publicPath: '/',
  },
});
mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [])
  .postCss('resources/css/datepicker.css', 'public/css', [])
  .js('resources/src/js/index.js', 'public/assets/js/bundle.min.js')
  .sass('resources/src/sass/style.scss', 'public/assets/css/style.min.css').options({
    processCssUrls: false,
  })
  .sass('resources/src/sass/style_pdf.scss', 'public/assets/css/style_pdf.min.css').options({
    processCssUrls: false,
  })
  .sourceMaps(productionSourceMaps, 'source-map');
