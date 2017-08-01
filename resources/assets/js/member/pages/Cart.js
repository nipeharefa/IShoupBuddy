import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import CartCounter from 'lib/CartCounter'
import VueLazyload from 'vue-lazyload'
import { mapActions, mapGetters } from 'vuex'
import store from 'member/store/Cart/'
import VueEcho from 'lib/echo-pusher-plugin'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueEcho)
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(CartCounter)
Vue.directive('click-outside', clickOutside)

const App = r => require.ensure([], () => r(require('member/components/Cart/Cart.vue')), 'mem-cart')

new Vue({
  store,
  created () {
    this.initActiveUser(window._sharedData.user)
    this.getCarts()
    this.getCategories()
  },
  computed: {
    ...mapGetters(['activeUser'])
  },
  methods: {
    ...mapActions([
      'initActiveUser',
      'initCarts',
      'initCategories'
    ]),
    getCarts () {
      const userid = this.activeUser.id
      this.$http.get(`api/user/${userid}/carts`).then(response => {
        this.initCarts(response.data)
      })
    },
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
      }).catch(err => err)
    }

  },
  render (h) {
    return (
      <App />
    )
  }
}).$mount('#app')
