import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueEcho from 'lib/echo-pusher-plugin'
import CartCounter from 'lib/CartCounter'
import GetCategory from 'lib/GetCategory'
import VueLazyload from 'vue-lazyload'
import store from 'member/store/home/'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(VueEcho)
Vue.use(CartCounter)

const App = r => require.ensure([], () => r(require('member/components/compare/Compare.vue')))
import { mapActions } from 'vuex'

new Vue({
  created () {
    this.getCategories()
    this.initActiveUser(window._sharedData.user)
  },
  store,
  render (h) {
    return (
      <App />
    )
  },
  methods: {
    ...mapActions(['initCategories', 'initActiveUser']),
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
      }).catch(err => err)
    }
  }
}).$mount('#app')
