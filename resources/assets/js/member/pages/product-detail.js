import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'member/components/product-detail/ProductDetail.vue'

import store from 'member/store/product-detail/'

import { mapActions, mapGetters } from 'vuex'
new Vue({
  created () {
    this.getProductDetail()
  },
  store,
  computed: {
    ...mapGetters([
      'product'
    ])
  },
  methods: {
    ...mapActions([
      'initProduct'
    ]),
    getProductDetail () {
      const id = window._sharedData.product_id
      this.$http.get(`api/product/${id}`).then(response => {
        this.initProduct(response.data.product)
      }).catch(err => err)
    }
  },
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
