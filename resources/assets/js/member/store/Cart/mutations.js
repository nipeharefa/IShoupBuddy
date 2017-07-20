import { SET_TOTAL_CART, INIT_CATEGORIES } from 'mutationsStore'
export default {

  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  INIT_CARTS (state, carts) {
    state.carts = carts
  },
  SET_TOTAL_CART,
  INIT_CATEGORIES
}
