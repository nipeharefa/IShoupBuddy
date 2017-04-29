import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VeeValidate from 'vee-validate'

Vue.use(VueAxios)
Vue.use(VeeValidate)

import store from 'vendor/store/product-index'

import App from 'vendor/components/product/index'
new Vue({
  store,
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
