import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import VueLazyload from 'vue-lazyload'
import clickOutside from 'lib/click-outside.js'
import Raven from 'raven-js'
import RavenVue from 'raven-js/plugins/vue'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)
const App = r => require.ensure([], () => r(require('guest/components/home/Home.vue')), 'hombes')

Raven
  .config('https://6d1ae4151da84747afc17265d8ca9d2b@sentry.io/180639')
  .addPlugin(RavenVue, Vue)
  .install()

import { mapActions } from 'vuex'

new Vue({
  created () {
    this.getCategories()
  },
  store,
  render (h) {
    return (
			<App />
    )
  },
  methods: {
    ...mapActions([
      'initCategories'
    ]),
    getCategories () {
      this.$http.get('api/category').then(response => {
        this.initCategories(response.data.categories)
      }).catch(err => err)
    }
  }
}).$mount('#app')
