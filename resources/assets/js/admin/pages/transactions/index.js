import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'adminComponents/transactions/index/Index.vue'
new Vue({
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
