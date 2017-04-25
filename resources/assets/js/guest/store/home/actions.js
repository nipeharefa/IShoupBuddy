import { INIT_PROMO, INIT_PRODUCTS } from 'globalVuexConstant'

export const initPromo = ({ commit }, promo) => {
  commit(INIT_PROMO, promo)
}
export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}
