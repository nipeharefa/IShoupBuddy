// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

const strict = false

const namespaced = false

const state = {
  transactions: null,
  transaction: null
}

export default {
  state,
  strict,
  getters,
  actions,
  mutations,
  namespaced
}
