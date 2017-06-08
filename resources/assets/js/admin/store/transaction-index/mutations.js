export default {
  INIT_TRANSACTIONS (state, transactions) {
    state.transactions = transactions
  },
  INIT_PRODUCTS (state, products) {
    state.products = products
  },
  SET_ON_ERROR (state, error) {
    state.onError = error
  }
}
