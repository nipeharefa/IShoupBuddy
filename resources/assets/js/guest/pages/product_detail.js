import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)
import App from 'guest/components/product_detail/ProductDetail.vue'
import store from 'guest/store/product-detail/'
import { mapActions, mapGetters } from 'vuex'
new Vue({
  store,
  created () {
    this.getProductDetail()
  },
  methods: {
    ...mapActions([
      'initProduct'
    ]),
    getProductDetail () {
      const id = window._sharedData.product_id
      this.$http.get(`api/product/${id}?with=review`).then(response => {
        this.initProduct(response.data.product)
      }).catch(err => err)
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
