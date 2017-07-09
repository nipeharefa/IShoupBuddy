import { SET_ISACTIVE, SET_SEARCH_ACTIVE, UPDATE_ACTIVE_USER } from 'mutationsStore'

export default {

  INIT_ACTIVE_USER (state, user) {
    state.activeUser = user
  },
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  UPDATE_ACTIVE_USER
}
