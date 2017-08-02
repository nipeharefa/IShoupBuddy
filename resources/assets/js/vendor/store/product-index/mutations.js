import {
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  UPDATE_ACTIVE_USER,
  INIT_CATEGORIES
} from 'mutationsStore'

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
  UPDATE_ACTIVE_USER,
  INIT_CATEGORIES,
  INIT_OWN_PRODUCTS (state, products) {
    state.ownProducts = products
  },
  UPDATE_PRODUCT (state, obj) {
    state.splice(obj.index, 1, obj.data)
  },
  INIT_OWN_PRODUCT (state, product) {
    state.ownProduct = product
  },
  UPDATE_OWN_PRODUCT (state, data) {
    state.ownProducts[data.index] = data.product
  },
  ADD_OWN_PRODUCT (state, data) {
    state.ownProducts.push(data)
  }
}
