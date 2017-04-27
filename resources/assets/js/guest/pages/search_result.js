import Vue from 'vue'

import VueAxios from 'lib/axios-plugin'

Vue.use(VueAxios)

import App from 'guest/components/search-results/SearchResults.vue'

new Vue({
  render (h) {
    return (
      <div>
        <App />
      </div>
    )
  }
}).$mount('#app')
