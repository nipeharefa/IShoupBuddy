import Echo from 'laravel-echo'
import { PUSHER_KEYS } from './pusher-conf'

window.Pusher = require('pusher-js')
window.keyPusher = PUSHER_KEYS
const echo = new Echo({
  broadcaster: 'pusher',
  key: '37ca8f9beb8432c37194',
  cluster: 'mt1',
  authEndpoint: '/broadcasting/auth'
})
export default (Vue) => {
  Object.defineProperties(Vue.prototype, {
    $echo: {
      get () {
        return echo
      }
    }
  })
}
