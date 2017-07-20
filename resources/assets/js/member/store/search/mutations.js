import { SET_ISACTIVE, SET_SEARCH_ACTIVE, SET_TOTAL_CART, INIT_CATEGORIES } from 'mutationsStore'

export default {

  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  INIT_PRODUCTS (state, products) {
    state.products = products
  },
  INIT_PROMO (state, promo) {
    state.promo = promo
  },
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  SET_TOTAL_CART,
  INIT_CATEGORIES
}
