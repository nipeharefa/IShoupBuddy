import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
Vue.use(VueAxios)

import App from 'member/components/search/Search.vue'

import store from 'member/store/search/'

import { mapActions } from 'vuex'

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
