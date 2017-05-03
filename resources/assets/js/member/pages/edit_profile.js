import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import ImageUploader from 'lib/imageuploader'
import VeeValidate from 'vee-validate'


Vue.use(VueAxios)
Vue.use(ImageUploader)
Vue.use(VeeValidate)

import App from 'member/components/edit-profile/EditProfile.vue'

new Vue({
  render (h) {
    return (
			<div class=''>
				<App />
			</div>
    )
  }
}).$mount('#app')
