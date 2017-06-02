let mix = require('laravel-mix')


// Admin Sass

mix.sass('resources/assets/sass/pages/admin/auth/login.scss', 'css/admin/auth/login.css')
mix.sass('resources/assets/sass/pages/admin/product/index.scss', 'css/admin/product/index.css')
mix.sass('resources/assets/sass/pages/admin/product/create.scss', 'css/admin/product/create.css')
mix.sass('resources/assets/sass/pages/admin/product/edit.scss', 'css/admin/product/edit.css')
mix.sass('resources/assets/sass/pages/admin/vendor/index.scss', 'css/admin/vendor/index.css')
mix.sass('resources/assets/sass/pages/admin/transactions/index.scss', 'css/admin/transactions/index.css')


// Admin JS

mix.js('resources/assets/js/admin/pages/auth/login.js', 'js/a-auth-login.js')
mix.js('resources/assets/js/admin/pages/product/product-index.js', 'js/a-index-product.js')
mix.js('resources/assets/js/admin/pages/product/product-create.js', 'js/a-add-product.js')
mix.js('resources/assets/js/admin/pages/product/product-edit.js', 'js/a-edit-product.js')
mix.js('resources/assets/js/admin/pages/vendor/vendor-index.js', 'js/a-vendor-user.js')
mix.js('resources/assets/js/admin/pages/transactions/index.js', 'js/a-transactions-index.js')

// Guest JS

mix.sass('resources/assets/sass/pages/guest/home.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/product_detail.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/login.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/register.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/search_result.scss', 'css/guest')

// Guest SASS

mix.js('resources/assets/js/guest/pages/home.js', 'js/home.js')
mix.js('resources/assets/js/guest/pages/product_detail.js', 'js/product_detail.js')
mix.js('resources/assets/js/guest/pages/login.js', 'js/login_default.js')
mix.js('resources/assets/js/guest/pages/register.js', 'js/register.js')
mix.js('resources/assets/js/guest/pages/search_result.js', 'js/search_result.js')


// Member JS

mix.js('resources/assets/js/member/pages/home.js', 'js/mhome.js')
mix.js('resources/assets/js/member/pages/product-detail.js', 'js/mproduct-detail.js')
mix.js('resources/assets/js/member/pages/me.js', 'js/me.js')
mix.js('resources/assets/js/member/pages/edit_profile.js', 'js/edit_profile.js')
mix.js('resources/assets/js/member/pages/search.js', 'js/msearch.js')


// Member SASS
mix.sass('resources/assets/sass/pages/member/home.scss', 'css/member/home.css')
mix.sass('resources/assets/sass/pages/member/me.scss', 'css/member/me.css')
mix.sass('resources/assets/sass/pages/member/edit_profile.scss', 'css/member/edit_profile.css')
mix.sass('resources/assets/sass/pages/member/product/product-detail.scss', 'css/member/product-detail.css')
mix.sass('resources/assets/sass/pages/member/search/index.scss', 'css/member/search.css')

mix.extract(['vue', 'axios', 'vee-validate'])

mix.disableNotifications()

mix.sourceMaps(); // Enable sourcemaps

if (mix.config.inProduction) {
  mix.version()
}

// mix.browserSync({
//   open: false,
//   proxy: 'skripsi.home.dev'
// });
