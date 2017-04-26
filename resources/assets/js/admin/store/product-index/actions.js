import { INIT_PRODUCTS } from 'globalVuexConstant'
export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}
