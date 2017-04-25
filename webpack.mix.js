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

mix.sass('resources/assets/sass/guest/login.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/register.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/home.scss', 'css/guest')
mix.sass('resources/assets/sass/guest/product_detail.scss', 'css/guest')


mix.sass('resources/assets/sass/member/home.scss', 'css/member/home.css')

mix.sass('resources/assets/sass/member/me.scss', 'css/member/me.css')
mix.sass('resources/assets/sass/member/change_password.scss', 'css/member/change_password.css')
mix.sass('resources/assets/sass/member/transactions.scss', 'css/member/transactions.css')
mix.sass('resources/assets/sass/member/transactions/show_transaction.scss', 'css/member/show_transaction.css')
mix.sass('resources/assets/sass/member/edit_profile.scss', 'css/member/edit_profile.css')
mix.sass('resources/assets/sass/member/product_favorite.scss', 'css/member/product_favorite.css')

/**
 * Admin SCSS and JS
 */
mix.sass('resources/assets/sass/admin/product/index.scss', 'css/admin/product/index.css')
mix.js('resources/assets/js/admin/pages/product/product-index.js', 'js/a-index-product.js')
mix.js('resources/assets/js/admin/pages/product/product-create.js', 'js/a-add-product.js')
mix.js('resources/assets/js/admin/pages/user/user-index.js', 'js/a-index-user.js')
mix.js('resources/assets/js/admin/pages/vendor/vendor-index.js', 'js/a-vendor-user.js')

/**
 * Guest
 */
mix.js('resources/assets/js/guest/pages/login.js', 'js/login_default.js')
mix.js('resources/assets/js/guest/pages/register.js', 'js/register.js')
mix.js('resources/assets/js/guest/pages/home.js', 'js/home.js')
mix.js('resources/assets/js/guest/pages/product_detail.js', 'js/product_detail.js')
mix.js('resources/assets/js/guest/pages/forgot_password.js', 'js/forgot_password.js')

// Member

mix.js('resources/assets/js/member/pages/home.js', 'js/mhome.js')

mix.js('resources/assets/js/member/pages/me.js', 'js/me.js')
mix.js('resources/assets/js/member/pages/edit_profile.js', 'js/edit_profile.js')
mix.js('resources/assets/js/member/pages/change_password.js', 'js/change_password.js')
mix.js('resources/assets/js/member/pages/transactions/transactions.js', 'js/member_transactions.js')
mix.js('resources/assets/js/member/pages/transactions/show_transaction.js', 'js/member_show_transaction.js')
mix.js('resources/assets/js/member/pages/product_favorite.js', 'js/product_favorite.js')

mix.extract(['vue', 'axios'])

mix.disableNotifications()

if (mix.config.inProduction) {
	mix.version()
}
mix.browserSync({
	open: false,
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
mix.sourceMaps(); // Enable sourcemaps
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
//
