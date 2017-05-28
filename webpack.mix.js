let mix = require('laravel-mix')


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


// Member SASS
mix.sass('resources/assets/sass/pages/member/home.scss', 'css/member/home.css')
mix.sass('resources/assets/sass/pages/member/me.scss', 'css/member/me.css')
mix.sass('resources/assets/sass/pages/member/edit_profile.scss', 'css/member/edit_profile.css')
mix.sass('resources/assets/sass/pages/member/product/product-detail.scss', 'css/member/product-detail.css')

mix.extract(['vue', 'axios', 'vee-validate'])

mix.disableNotifications()

if (mix.config.inProduction) {
  mix.version()
}
mix.browserSync({
  open: false,
  proxy: 'skripsi.home.dev'
});
