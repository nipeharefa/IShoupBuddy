import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'
import App from 'guest/components/product_detail/ProductDetail.vue'
import store from 'guest/store/product-detail/'
import { mapActions, mapGetters } from 'vuex'

Vue.use(VueLazyload)
Vue.use(VueAxios)

new Vue({
  store,
  created () {
    this.initDataVuex()
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
  computed: {
    ...mapGetters([
      'product'
    ])
  },
  render (h) {
    return (
      <div class=''>
				<App />
			</div>
    )
  }
}).$mount('#app')
