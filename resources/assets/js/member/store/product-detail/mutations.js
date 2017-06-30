import { SET_ISACTIVE, SET_SEARCH_ACTIVE } from 'mutationsStore'
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
  [INIT_RECOMMENDATION_PRODUCTS] (state, products) {
    state.recommendationProducts = products
  }
}
