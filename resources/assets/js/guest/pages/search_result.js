import Vue from 'vue'
import App from 'guest/components/search-results/SearchResults.vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'
import VueLazyload from 'vue-lazyload'

Vue.use(VueAxios)
Vue.use(VueLazyload)


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
