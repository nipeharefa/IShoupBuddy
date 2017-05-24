let mix = require('laravel-mix')


mix.sass('resources/assets/sass/pages/guest/home.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/product_detail.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/login.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/register.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/search_result.scss', 'css/guest')

mix.js('resources/assets/js/guest/pages/home.js', 'js/home.js')
mix.js('resources/assets/js/guest/pages/product_detail.js', 'js/product_detail.js')
mix.js('resources/assets/js/guest/pages/login.js', 'js/login_default.js')
mix.js('resources/assets/js/guest/pages/register.js', 'js/register.js')
mix.js('resources/assets/js/guest/pages/search_result.js', 'js/search_result.js')


// Member

mix.js('resources/assets/js/member/pages/home.js', 'js/mhome.js')
mix.sass('resources/assets/sass/pages/member/home.scss', 'css/member/home.css')

mix.extract(['vue', 'axios', 'vee-validate'])

mix.disableNotifications()

if (mix.config.inProduction) {
  mix.version()
}
mix.browserSync({
  open: false,
  proxy: 'skripsi.home.dev'
});
