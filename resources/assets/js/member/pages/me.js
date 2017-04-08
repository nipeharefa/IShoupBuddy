import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'

Vue.use(VueAxios)

import App from 'member/components/me/Me.vue'

new Vue({
	render(h) {
		return (
			<div class="all-me">
				<App />
			</div>
		)
	}
}).$mount("#app")