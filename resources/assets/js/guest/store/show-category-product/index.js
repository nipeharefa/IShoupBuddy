import Vue from 'vue'
import Vuex from 'vuex'
// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

import { isActive, searchActive, activeUser, categories } from 'statesStore'

Vue.use(Vuex)

const strict = process.env.NODE_ENV !== 'production'

const state = {
  promo: [],
  products: null,
  isActive,
  searchActive,
  activeUser,
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