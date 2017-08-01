import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import VueLazyload from 'vue-lazyload'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.directive('click-outside', clickOutside)
const App = r => require.ensure([], () => r(require('guest/components/home/Home.vue')), 'hombes')

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
