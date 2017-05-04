import { SET_ISACTIVE, SET_SEARCH_ACTIVE } from 'mutationsStore'

export default {

  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  INIT_PRODUCT (state, product) {
    state.product = product
  },
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE
}
