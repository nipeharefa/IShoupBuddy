export default (Vue, options) => {
  Vue.prototype.$getCartCounter = () => {
    console.log(Vue.activeUser)
  }
}
