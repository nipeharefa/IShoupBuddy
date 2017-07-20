import Vue from 'vue'
import Vuex from 'vuex'

// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'
import transaction from './transaction'
import wishlist from './wishlist'

Vue.use(Vuex)

import { isActive, searchActive, totalCart, categories } from 'statesStore'

const strict = process.env.NODE_ENV !== 'production'

const modules = {
  transaction,
  wishlist
}

const state = {
  activeUser: {},
  isActive,
  searchActive,
  totalCart,
  categories
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
