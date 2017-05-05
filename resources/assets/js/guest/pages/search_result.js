import Vue from 'vue'
import App from 'guest/components/search-results/SearchResults.vue'
import VueAxios from 'lib/axios-plugin'
import store from 'guest/store/home/'

Vue.use(VueAxios)


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
