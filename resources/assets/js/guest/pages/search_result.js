import Vue from 'vue'
import App from 'guest/components/search-results/SearchResults.vue'
import VueAxios from 'lib/axios-plugin'
import GetCategory from 'lib/GetCategory'
import store from 'guest/store/search/'
import VueLazyload from 'vue-lazyload'

Vue.use(VueAxios)
Vue.use(VueLazyload)
Vue.use(GetCategory)

new Vue({
  store,
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
