import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'adminComponents/transactions/index/Index.vue'
import store from 'admin/store/transaction-index'
new Vue({
  store,
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
