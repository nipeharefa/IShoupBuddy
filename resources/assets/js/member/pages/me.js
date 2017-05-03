import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from '../store/me'

Vue.use(VueAxios)

import App from 'member/components/me/Me.vue'
import { mapActions } from 'vuex'

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
