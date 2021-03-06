import Vue from 'vue'
import Vuex from 'vuex'
// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

import { isActive, searchActive, activeUser, totalCart, categories } from 'statesStore'

Vue.use(Vuex)

const strict = false

const state = {
  activeUser,
  isActive,
  searchActive,
  carts: [],
  totalCart,
  cartCounter: 0,
  categories
}

const store = new Vuex.Store({
  state,
  mutations,
  actions,
  getters,
  strict
})

export default store
