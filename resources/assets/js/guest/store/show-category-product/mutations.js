import { SET_ISACTIVE, SET_SEARCH_ACTIVE, INIT_CATEGORIES } from 'mutationsStore'
export default {

  INIT_PROMO (state, promo) {
    state.promo = promo
  },
  INIT_PRODUCTS (state, products) {
    state.products = products
  },
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  INIT_CATEGORIES
}
