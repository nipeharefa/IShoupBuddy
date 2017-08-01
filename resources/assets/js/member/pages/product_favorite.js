import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import clickOutside from 'lib/click-outside.js'
Vue.directive('click-outside', clickOutside)

Vue.use(VueAxios)

import App from 'member/components/product_favorite/ProductFavorite.vue'

new Vue({
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
