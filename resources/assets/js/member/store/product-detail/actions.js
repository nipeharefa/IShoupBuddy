import { INIT_ACTIVE_USER, INIT_PRODUCT } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}
export const initProduct = ({ commit }, product) => {
  commit(INIT_PRODUCT, product)
}

export { setIsActive, setSearchActive } from 'actionsStore'
