import {
  INIT_WISHLISTS
} from 'globalVuexConstant'

export const initWishlists = ({ commit }, wishlists) => {
  commit(INIT_WISHLISTS, wishlists)
}
