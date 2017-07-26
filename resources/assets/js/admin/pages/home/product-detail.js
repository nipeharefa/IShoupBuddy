import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import VueEcho from 'lib/echo-pusher-plugin'
import CartCounter from 'lib/CartCounter'
Vue.use(VueEcho)
Vue.use(VueLazyload)
Vue.use(VueAxios)
Vue.use(CartCounter)

import App from 'admin/components/product-detail/ProductDetail.vue'
import store from 'member/store/product-detail/'
import { mapActions, mapGetters } from 'vuex'

new Vue({
  created () {
    this.initDataVuex()
    this.initActiveUser(window._sharedData.user)
    this.getCategories()
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
      'initRecommendationProducts',
      'initActiveUser',
      'initCategories'
    ]),
    initDataVuex () {
      this.getProductDetail()
      this.getRecomendationProducts()
      this.initActiveUser(window._sharedData.user)
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
    },
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
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
