import {
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  SET_TOTAL_CART,
  WISH_PRODUCT,
  INIT_CATEGORIES
} from 'mutationsStore'
import { INIT_ACTIVE_USER, INIT_PRODUCT, INIT_RECOMMENDATION_PRODUCTS } from 'globalVuexConstant'

export default {

  [INIT_ACTIVE_USER] (state, user) {
    state.activeUser = user
  },
  [INIT_PRODUCT] (state, product) {
    state.product = product
  },
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  SET_TOTAL_CART,
  WISH_PRODUCT,
  INIT_CATEGORIES,
  [INIT_RECOMMENDATION_PRODUCTS] (state, products) {
    state.recommendationProducts = products
  }
}
