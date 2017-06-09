import { INIT_USERS, INIT_USER } from 'globalVuexConstant'
export const initVendors = ({ commit }, users) => {
  commit(INIT_USERS, users)
}

export const initProduct = ({ commit }, user) => {
  commit(INIT_USER, user)
}
