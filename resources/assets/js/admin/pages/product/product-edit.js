import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

const App = () => import('adminProduct/edit/ProductEdit.vue')
import store from 'admin/store/product-edit'

import { mapActions } from 'vuex'

new Vue({
  created () {
    this.getProduct()
  },
  store,
  methods: {
    ...mapActions([
      'initProduct'
    ]),
    getProduct () {
      const productId = window.__sharedData.product_id
      this.$http.get('api/product/' + productId).then(response => {
        this.initProduct(response.data.product)
      }).catch(err => err)
    }
  },
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
