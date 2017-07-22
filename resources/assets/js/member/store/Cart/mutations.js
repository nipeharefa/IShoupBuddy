import { SET_TOTAL_CART, INIT_CATEGORIES } from 'mutationsStore'
import { UPDATE_QUANTITY } from 'globalVuexConstant'
export default {

  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  INIT_CARTS (state, carts) {
    state.carts = carts
  },
  SET_TOTAL_CART,
  INIT_CATEGORIES,
  [UPDATE_QUANTITY] (state, obj) {
    state.carts.carts[obj.cartIndex]['item'][obj.itemIndex]['quantity'] = obj.quantity
  }

}
