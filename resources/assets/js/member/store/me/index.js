import Vue from 'vue'
import Vuex from 'vuex'

// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'
import transaction from './transaction'

Vue.use(Vuex)

import { isActive, searchActive, totalCart } from 'statesStore'

const strict = process.env.NODE_ENV !== 'production'

const modules = {
  transaction
}

const state = {
  activeUser: {},
  isActive,
  searchActive,
  totalCart
}

const store = new Vuex.Store({
  state,
  mutations,
  actions,
  getters,
  strict,
  modules
})

export default store
