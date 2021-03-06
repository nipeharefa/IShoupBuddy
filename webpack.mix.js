let mix = require('laravel-mix')

// Admin Sass

mix.sass('resources/assets/sass/pages/admin/auth/login.scss', 'css/admin/auth/login.css')
mix.sass('resources/assets/sass/pages/admin/transactions/index.scss', 'css/admin/transactions/index.css')
mix.sass('resources/assets/sass/pages/admin/home/home.scss', 'css/admin/home/index.css')


// Admin JS

mix.js('resources/assets/js/admin/pages/auth/login.js', 'js/a-auth-login.js')
mix.js('resources/assets/js/admin/pages/home/home.js', 'js/ahome.js')
mix.js('resources/assets/js/admin/pages/transactions/index.js', 'js/a-transactions-index.js')
mix.js('resources/assets/js/admin/pages/home/product-detail.js', 'js/a-product_detail.js')
mix.js('resources/assets/js/admin/pages/home/a-show-category-product.js', 'js/a-show-category-product.js')
mix.js('resources/assets/js/admin/pages/home/search.js', 'js/a-search.js')

// Guest SASS

mix.sass('resources/assets/sass/pages/guest/home.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/product_detail.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/login.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/register.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/search_result.scss', 'css/guest')
mix.sass('resources/assets/sass/pages/guest/show-category-product.scss', 'css/g-show-category-product.css')
mix.sass('resources/assets/sass/pages/guest/compare.scss', 'css/g-compare.css')
mix.sass('resources/assets/sass/pages/guest/compare-result.scss', 'css/g-compare-result.css')
mix.sass('resources/assets/sass/pages/guest/about.scss', 'css/about.css')

// Guest JS

mix.js('resources/assets/js/guest/pages/home.js', 'js/home.js')
mix.js('resources/assets/js/guest/pages/product_detail.js', 'js/product_detail.js')
mix.js('resources/assets/js/guest/pages/login.js', 'js/login_default.js')
mix.js('resources/assets/js/guest/pages/register.js', 'js/register.js')
mix.js('resources/assets/js/guest/pages/search_result.js', 'js/search_result.js')
mix.js('resources/assets/js/guest/pages/g-show-category-product.js', 'js/g-show-category-product.js')
mix.js('resources/assets/js/guest/pages/compare.js', 'js/g-compare-js.js')
mix.js('resources/assets/js/guest/pages/g-compare-result.js', 'js/g-compare-result.js')

mix.js('resources/assets/js/guest/pages/about.js', 'js/about.js')
mix.js('resources/assets/js/guest/pages/pengumuman.js', 'js/pengumuman.js')
mix.js('resources/assets/js/guest/pages/syarat-ketentuan.js', 'js/syarat-ketentuan.js')
mix.js('resources/assets/js/guest/pages/Privacy.js', 'js/privacy.js')


// Member JS

mix.js('resources/assets/js/member/pages/home.js', 'js/mhome.js')
mix.js('resources/assets/js/member/pages/product-detail.js', 'js/mproduct-detail.js')
mix.js('resources/assets/js/member/pages/me.js', 'js/me.js')
mix.js('resources/assets/js/member/pages/edit_profile.js', 'js/edit_profile.js')
mix.js('resources/assets/js/member/pages/search.js', 'js/msearch.js')
mix.js('resources/assets/js/member/pages/Cart.js', 'js/m-cart.js')
mix.js('resources/assets/js/member/pages/m-show-category-product.js', 'js/m-show-category-product.js')
mix.js('resources/assets/js/member/pages/checkout.js', 'js/m-checkout.js')
mix.js('resources/assets/js/member/pages/compare.js', 'js/m-compare.js')
mix.js('resources/assets/js/member/pages/compare-result.js', 'js/m-compare-result.js')
mix.js('resources/assets/js/member/pages/about.js', 'js/m-about.js')


// Member SASS
mix.sass('resources/assets/sass/pages/member/home.scss', 'css/member/home.css')
mix.sass('resources/assets/sass/pages/member/me.scss', 'css/member/me.css')
mix.sass('resources/assets/sass/pages/member/edit_profile.scss', 'css/member/edit_profile.css')
mix.sass('resources/assets/sass/pages/member/product/product-detail.scss', 'css/member/product-detail.css')
mix.sass('resources/assets/sass/pages/member/search/index.scss', 'css/member/search.css')
mix.sass('resources/assets/sass/pages/member/Cart.scss', 'css/member/cart.css')
mix.sass('resources/assets/sass/pages/member/checkout.scss', 'css/m-checkout.css')
mix.sass('resources/assets/sass/pages/member/compare.scss', 'css/m-compare.css')
mix.sass('resources/assets/sass/pages/member/compare-result.scss', 'css/m-compare-result.css')

// Vendor JS
mix.js('resources/assets/js/vendor/pages/home/home.js', 'js/vhome.js')
mix.js('resources/assets/js/vendor/pages/auth/login.js', 'js/vendor_login.js')
mix.js('resources/assets/js/vendor/pages/product/index.js', 'js/vendor_product_index.js')
mix.js('resources/assets/js/vendor/pages/home/product-detail.js', 'js/v-product_detail.js')
mix.js('resources/assets/js/vendor/pages/home/v-show-category-product.js', 'js/v-show-category-product.js')
mix.js('resources/assets/js/vendor/pages/home/search.js', 'js/v-search.js')

// Vendor SASS
mix.sass('resources/assets/sass/pages/vendor/home.scss', 'css/vendor/home.css')
mix.sass('resources/assets/sass/pages/vendor/auth/login.scss', 'css/vendor/login.css')
mix.sass('resources/assets/sass/pages/vendor/product/index.scss', 'css/vendor/product/index.css')


// Polifyl
mix.js('resources/assets/js/polifyls/ArrayFindIndex.js', 'js/polifyls07.js')

mix.extract(['vue', 'axios', 'vee-validate', 'vue-lazyload', 'vuex'])

mix.webpackConfig({
  devServer: {
    stats: {
      chunks: false
    }
  },
  output: {
    publicPath: '/'
  },
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.common.js',
      guest: path.resolve(__dirname, 'resources/assets/js/guest'),
      global: path.resolve(__dirname, 'resources/assets/js/global'),
      member: path.resolve(__dirname, 'resources/assets/js/member'),
      admin: path.resolve(__dirname, 'resources/assets/js/admin'),
      vendor: path.resolve(__dirname, 'resources/assets/js/vendor'),
      adminProduct: path.resolve(__dirname, 'resources/assets/js/admin/components/product'),
      adminComponents: path.resolve(__dirname, 'resources/assets/js/admin/components'),
      otherComponents: path.resolve(__dirname, 'resources/assets/js/components'),
      lib: path.resolve(__dirname, 'resources/assets/js/lib'),
      designHelper: path.resolve(__dirname, 'resources/assets/sass/core/helpers'),
      sassBase: path.resolve(__dirname, 'resources/assets/sass/base'),
      sassComponents: path.resolve(__dirname, 'resources/assets/sass/components'),
      sassComponents: path.resolve(__dirname, 'resources/assets/sass/components'),
      sassExtentions: path.resolve(__dirname, 'resources/assets/sass/extentions'),
      sassPages: path.resolve(__dirname, 'resources/assets/sass/pages'),
      'globalVuexConstant$': path.resolve(__dirname, 'resources/assets/js/constant.js'),

      // Globaal Components, Store
      'mutationsStore$': path.resolve(__dirname, 'resources/assets/js/global/store/mutations.js'),
      'actionsStore$': path.resolve(__dirname, 'resources/assets/js/global/store/actions.js'),
      'gettersStore$': path.resolve(__dirname, 'resources/assets/js/global/store/getters.js'),
      'statesStore$': path.resolve(__dirname, 'resources/assets/js/global/store/states.js')
    }
  }
})

mix.disableNotifications()

// mix.sourceMaps(); // Enable sourcemaps

if (mix.config.inProduction) {
  mix.version()
}

mix.browserSync({
  open: false,
  proxy: 'skripsi.home.dev',
  reloadDelay: 1000
});

mix.options({
  extractVueStyles: true,
});
