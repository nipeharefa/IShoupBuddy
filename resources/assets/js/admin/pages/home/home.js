import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import VueLazyload from 'vue-lazyload'

Vue.use(VueAxios)
Vue.use(VueLazyload)

new Vue({
  render (h) {
    return (
      <div>
      </div>
    )
  }
}).$mount('#app')
