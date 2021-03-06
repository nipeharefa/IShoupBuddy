import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'adminComponents/vendor/index/VendorIndex.vue'

new Vue({
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
