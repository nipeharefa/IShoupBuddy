import { INIT_ACTIVE_USER, INIT_PRODUCTS } from '../constants'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}
export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}
