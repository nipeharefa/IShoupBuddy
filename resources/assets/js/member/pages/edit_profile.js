import Vue from 'vue'
import VueAxios from 'lib/axios-plugin'
import ImageUploader from 'lib/imageuploader'

Vue.use(VueAxios)
Vue.use(ImageUploader)

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
