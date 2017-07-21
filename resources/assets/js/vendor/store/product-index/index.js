import Vue from 'vue'
import Vuex from 'vuex'
// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'

import review from './modules/review'

import { isActive, searchActive, activeUser, product, categories } from 'statesStore'

Vue.use(Vuex)

const strict = false

const modules = {
  review
}

const state = {
  activeUser,
  promo: [],
  products: [],
  isActive,
  searchActive,
  product,
  ownProducts: null,
  ownProduct: null,
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
