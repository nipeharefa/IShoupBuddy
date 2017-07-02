import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import VueEcho from 'lib/echo-pusher-plugin'
Vue.use(VueEcho)
Vue.use(VueLazyload)
Vue.use(VueAxios)

import App from 'member/components/product-detail/ProductDetail.vue'

import store from 'member/store/product-detail/'

import { mapActions, mapGetters } from 'vuex'

new Vue({
  created () {
    this.initDataVuex()
  },
  store,
  computed: {
    ...mapGetters([
      'product'
    ])
  },
  methods: {
    ...mapActions([
      'initProduct',
      'initRecommendationProducts'
    ]),
    initDataVuex () {
      this.getProductDetail()
      this.getRecomendationProducts()
    },
    getProductDetail () {
      const id = window._sharedData.product_id
      this.$http.get(`api/product/${id}?with=review`).then(response => {
        this.initProduct(response.data.product)
      }).catch(err => err)
    },
    getRecomendationProducts () {
      this.$http.get('api/recommendation').then(response => {
        this.initRecommendationProducts(response.data.products)
      })
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
