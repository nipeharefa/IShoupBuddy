import { INIT_ACTIVE_USER, INIT_PRODUCTS, INIT_PROMO } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}
export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}
export const initPromo = ({ commit }, promo) => {
  commit(INIT_PROMO, promo)
}

export {
  setIsActive,
  setSearchActive,
  setTotalCart
} from 'actionsStore'
