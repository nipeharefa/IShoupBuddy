import { SET_ON_ERROR, INIT_PRODUCT } from 'globalVuexConstant'
export const setOnError = ({ commit }, error) => {
  commit(SET_ON_ERROR, error)
}
export const initProduct = ({ commit }, product) => {
  commit(INIT_PRODUCT, product)
}
