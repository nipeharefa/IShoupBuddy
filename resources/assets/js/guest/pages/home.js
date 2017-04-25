import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
Vue.use(VueAxios)

import App from 'guest/components/home/Home.vue'

new Vue({
  store,
  render (h) {
    return (
			<div>
				<App />
			</div>
    )
  }
}).$mount('#app')
