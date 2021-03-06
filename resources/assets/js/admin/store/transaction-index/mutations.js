import { SET_ISACTIVE, SET_SEARCH_ACTIVE, INIT_REVIEWS, INIT_REVIEW, INIT_REPORT_REVIEWS } from 'mutationsStore'

export default {
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  INIT_REVIEWS,
  INIT_REVIEW,
  INIT_REPORT_REVIEWS,
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
  },
  UPDATE_PRODUCT (state, data) {
    state.products[data.index] = data.product
  },
  UPDATE_TRANSACTION (state, obj) {
    state.transactions.splice(obj.index, 1, obj.data)
  }
}
