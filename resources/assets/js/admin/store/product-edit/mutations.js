export default {
  SET_ON_ERROR (state, error) {
    state.onError = error
  },
  INIT_PRODUCT (state, product) {
    state.product = product
  }
}
