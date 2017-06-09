import { INIT_USERS, INIT_USER } from 'globalVuexConstant'
export default {
  [INIT_USERS] (state, users) {
    state.users = users
  },
  [INIT_USER] (state, user) {
    state.user = user
  }
}
