import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'

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
