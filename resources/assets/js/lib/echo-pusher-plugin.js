import Echo from 'laravel-echo'
import { PUSHER_KEYS } from './pusher-conf'

window.Pusher = require('pusher-js')
window.keyPusher = PUSHER_KEYS
const echo = new Echo({
  broadcaster: 'pusher',
  key: PUSHER_KEYS,
  cluster: 'mt1',
  authEndpoint: '/broadcasting/auth',
  encrypted: true
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
