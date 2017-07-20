import { INIT_ACTIVE_USER, INIT_CARTS } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const initCarts = ({ commit }, carts) => {
  commit(INIT_CARTS, carts)
}

export {
  setIsActive,
  setSearchActive,
  setTotalCart,
  initCategories
} from 'actionsStore'
