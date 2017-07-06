import { SET_ISACTIVE, SET_SEARCH_ACTIVE } from 'mutationsStore'

export default {
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  INIT_TRANSACTIONS (state, transactions) {
    state.transactions = transactions
  },
  INIT_PRODUCTS (state, products) {
    state.products = products
  },
  SET_ON_ERROR (state, error) {
    state.onError = error
  },
  INIT_PRODUCT (state, product) {
    state.product = product
  }
}
