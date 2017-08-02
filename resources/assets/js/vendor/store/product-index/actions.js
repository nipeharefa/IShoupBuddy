import {
  INIT_ACTIVE_USER,
  INIT_PRODUCTS, INIT_PROMO,
  INIT_OWN_PRODUCTS, INIT_OWN_PRODUCT,
  UPDATE_OWN_PRODUCT,
  ADD_OWN_PRODUCT,
  UPDATE_PRODUCT
} from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}

export const updateProduct = ({ commit }, obj) => {
  commit(UPDATE_PRODUCT, obj)
}

export const initPromo = ({ commit }, promo) => {
  commit(INIT_PROMO, promo)
}

export const initOwnProducts = ({ commit }, products) => {
  commit(INIT_OWN_PRODUCTS, products)
}

export const initOwnProduct = ({ commit }, product) => {
  commit(INIT_OWN_PRODUCT, product)
}

export const updateOwnProduct = ({ commit }, data) => {
  commit(UPDATE_OWN_PRODUCT, data)
}

export const addOwnProduct = ({ commit }, data) => {
  commit(ADD_OWN_PRODUCT, data)
}

export { setIsActive, setSearchActive, updateActiveUser, initCategories } from 'actionsStore'
