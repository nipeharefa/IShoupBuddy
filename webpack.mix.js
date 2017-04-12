let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/assets/js/guest/pages/login.js', 'js/guest/login.js')
	.js('resources/assets/js/guest/pages/register.js', 'js/guest/register.js')
	.js('resources/assets/js/guest/pages/home.js', 'js/guest/home.js')
	.js('resources/assets/js/guest/pages/product_detail.js', 'js/guest/product_detail.js')
	.js('resources/assets/js/guest/pages/forgot_password.js', 'js/guest/forgot_password.js')

mix.extract(['vue', 'axios', 'vue-star-rating', 'otherComponents/Footer.vue'])


mix.js('resources/assets/js/member/pages/me.js', 'js/member/me.js')

mix.extract(['vue', 'axios'])
	

mix.sass('resources/assets/sass/guest/login.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/register.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/home.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/product_detail.scss', 'css/guest')


if (mix.config.inProduction) {
	mix.version()
}
mix.browserSync({
    proxy: 'skripsi.home.dev'
});

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('skripsi.home.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: true, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });