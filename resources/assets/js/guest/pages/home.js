import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import VueLazyload from 'vue-lazyload'
Vue.use(VueAxios)
Vue.use(VueLazyload)
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
