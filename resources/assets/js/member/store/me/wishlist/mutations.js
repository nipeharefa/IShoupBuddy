import {
  INIT_WISHLISTS
} from 'globalVuexConstant'

export default {
  [INIT_WISHLISTS] (state, wishlists) {
    state.wishlists = wishlists
  }
}
