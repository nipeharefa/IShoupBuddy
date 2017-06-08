import Vue from 'vue'
import Vuex from 'vuex'
// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const strict = process.env.NODE_ENV !== 'production'

const state = {
  transactions: [],
  products: [],
  onError: false
}

const store = new Vuex.Store({
  state,
  mutations,
  actions,
  getters,
  strict
})

export default store
