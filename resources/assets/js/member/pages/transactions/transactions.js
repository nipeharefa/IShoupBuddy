import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'member/components/transactions/Transactions.vue'

new Vue({
  render (h) {
    return (
      <div class=''>
        <App />
      </div>
    )
  }
}).$mount("#app")
