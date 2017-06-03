import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueProgressBar from 'vue-progressbar'
import router from 'admin/routers/transaction'
import store from 'admin/store/transaction-index'
import { sync } from 'vuex-router-sync'

sync(store, router)

import { mapActions } from 'vuex'

const App = r => require.ensure([], () => r(require('adminComponents/transactions/views/Main.vue')), 'group-foo')

Vue.use(VueProgressBar, { color: 'rgb(26, 146, 47)', failedColor: 'red', height: '3px' })
Vue.use(VueAxios)

const app = new Vue({
  render: h => h(App),
  router,
  store,
  created () {
    this.getTransactions()
  },
  methods: {
    ...mapActions([
      'initTransactions'
    ]),
    getTransactions () {
      this.$http.get('api/admin/transaction').then(response => {
        this.transaction = response.data.transactions
        this.initTransactions(response.data.transactions)
      }).catch(err => err)
    }
  }
})

router.onReady(() => {
  app.$mount('#app')
})
