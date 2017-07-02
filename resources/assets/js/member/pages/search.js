import Vue from 'vue'
import VueEcho from 'lib/echo-pusher-plugin'
import VueAxios from 'lib/axios-plugin'
import App from 'member/components/search/Search.vue'
import store from 'member/store/search/'
import { mapActions } from 'vuex'
Vue.use(VueAxios)
Vue.use(VueEcho)

new Vue({
  created () {
    this.initActiveUser(window._sharedData.user)
  },
  store,
  methods: {
    ...mapActions([
      'initActiveUser'
    ])
  },
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
