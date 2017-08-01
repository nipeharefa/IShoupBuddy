import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import ImageUploader from 'lib/imageuploader'
import VeeValidate from 'vee-validate'
import store from '../store/editprofile'
import clickOutside from 'lib/click-outside.js'
Vue.use(VueAxios)
Vue.use(ImageUploader)
Vue.use(VeeValidate)
Vue.directive('click-outside', clickOutside)

import { mapActions } from 'vuex'

import App from 'member/components/edit-profile/EditProfile.vue'

new Vue({
  store,
  created () {
    this.initActiveUser(window._sharedData.user)
  },
  render (h) {
    return (
			<div class=''>
				<App />
			</div>
    )
  },
  methods: {
    ...mapActions([
      'initActiveUser'
    ])
  }
}).$mount('#app')
