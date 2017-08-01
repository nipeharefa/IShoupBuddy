import Vue from 'vue'
import VueEcho from 'lib/echo-pusher-plugin'
import VueAxios from 'lib/axios-plugin'
import App from 'vendor/components/search/Search.vue'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/search/'
import { mapActions } from 'vuex'
import CartCounter from 'lib/CartCounter'
import clickOutside from 'lib/click-outside.js'

Vue.use(VueAxios)
Vue.use(VueEcho)
Vue.use(VueLazyload)
Vue.use(CartCounter)
Vue.directive('click-outside', clickOutside)

new Vue({
  created () {
    this.initActiveUser(window._sharedData.user)
    this.getCategories()
  },
  store,
  methods: {
    ...mapActions([
      'initActiveUser',
      'initCategories'
    ]),
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
      }).catch(err => err)
    }
  },
  render: h => h(App)
}).$mount('#app')
