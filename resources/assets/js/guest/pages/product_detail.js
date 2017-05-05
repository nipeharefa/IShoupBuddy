import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)
import App from 'guest/components/product_detail/ProductDetail.vue'
import store from 'guest/store/product-detail/'
new Vue({
  store,
  render (h) {
    return (
      <div class=''>
				<App />
			</div>
    )
  }
}).$mount('#app')
