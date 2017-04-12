import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)
import App from 'guest/components/product_detail/ProductDetail.vue'
new Vue({
	render(h) {
		return (
			<div class="">
				<App />
			</div>
		)
	}
}).$mount('#app')