import axios from 'axios'

axios.defaults.headers.common = {
  'X-CSRF-TOKEN': window.Laravel.csrfToken,
  'X-Requested-With': 'XMLHttpRequest'
}
axios.defaults.baseURL = window.location.origin
export default (Vue) => {
  Object.defineProperties(Vue.prototype, {
    $http: {
      get () {
        return axios
      }
    }
  })
}
