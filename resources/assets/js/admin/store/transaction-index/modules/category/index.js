// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

const strict = false

const namespaced = false

const state = {
  users: null,
  user: null,
  onError: false
}

export default {
  state,
  strict,
  getters,
  actions,
  mutations,
  namespaced
}
