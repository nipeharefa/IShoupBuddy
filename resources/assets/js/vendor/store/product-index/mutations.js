import { SET_ISACTIVE, SET_SEARCH_ACTIVE } from 'mutationsStore'

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
  INIT_OWN_PRODUCTS (state, products) {
    state.ownProducts = products
  },
  INIT_OWN_PRODUCT (state, product) {
    state.ownProduct = product
  }
}
