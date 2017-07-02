import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from '../store/me'
import VueEcho from 'lib/echo-pusher-plugin'
import App from 'member/components/me/Me.vue'
import { mapActions } from 'vuex'
Vue.use(VueEcho)
Vue.use(VueAxios)


new Vue({
  created () {
    this.initActiveUser(window._sharedData.user)
  },
  store,
  render (h) {
    return (
      <div>
        <App />
			</div>
    )
  },
  methods: {
    ...mapActions([
      'initActiveUser'
    ])
  }
}).$mount('#app')
