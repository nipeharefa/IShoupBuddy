import { INIT_ACTIVE_USER, SET_ISACTIVE, SET_SEARCH_ACTIVE } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const setIsActive = ({ commit }, status) => {
  commit(SET_ISACTIVE, status)
}

export const setSearchActive = ({ commit }, status) => {
  commit(SET_SEARCH_ACTIVE, status)
}
