import { INIT_USERS, INIT_USER } from 'globalVuexConstant'
export const initUsers = ({ commit }, users) => {
  commit(INIT_USERS, users)
}

export const initUser = ({ commit }, user) => {
  commit(INIT_USER, user)
}
