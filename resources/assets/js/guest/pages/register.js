import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'guest/components/register/Register.vue'

new Vue({
	render(h) {
		return (
			<div class="all">
				<App />
			</div>
		)
	}
}).$mount('#app')