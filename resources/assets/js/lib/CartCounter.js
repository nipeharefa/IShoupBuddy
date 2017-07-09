const CartCounter = {
  install (Vue, options) {
    Vue.mixin({
      mounted: function () {
        const active = this.activeUser
        if (active) {
          this.$myMethod()
        }
      }
    })
    Vue.prototype.$myMethod = function () {
      const id = this.activeUser.id
      this.$http.get(`/api/user/${id}/cartscounter`).then(response => {
        this.$store.commit('SET_TOTAL_CART', response.data.cart)
      }).catch(err => err)
    }
  }
}

export default CartCounter
