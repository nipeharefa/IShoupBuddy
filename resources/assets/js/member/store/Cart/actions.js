import { INIT_ACTIVE_USER, INIT_CARTS, UPDATE_QUANTITY } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const initCarts = ({ commit }, carts) => {
  commit(INIT_CARTS, carts)
}

export const updateBaru = ({ commit }, q) => {
  commit(UPDATE_QUANTITY, q)
}

export {
  setIsActive,
  setSearchActive,
  setTotalCart,
  initCategories
} from 'actionsStore'
