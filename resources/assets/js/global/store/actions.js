import {
  INIT_ACTIVE_USER,
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  UPDATE_ACTIVE_USER,
  SET_TOTAL_CART
} from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const updateActiveuser = ({ commit }, user) => {
  commit(UPDATE_ACTIVE_USER, user)
}

export const setIsActive = ({ commit }, status) => {
  commit(SET_ISACTIVE, status)
}

export const setSearchActive = ({ commit }, status) => {
  commit(SET_SEARCH_ACTIVE, status)
}

export const setTotalCart = ({ commit }, total) => {
  commit(SET_TOTAL_CART, total)
}

