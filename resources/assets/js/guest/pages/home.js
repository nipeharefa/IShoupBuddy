import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import App from 'guest/components/home/Home.vue'
Vue.use(VueAxios)

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
