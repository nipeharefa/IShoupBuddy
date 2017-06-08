import Vue from 'vue'
import Vuex from 'vuex'
// const Vuex = require('vuex').default

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'
import vendor from './modules/vendor'
Vue.use(Vuex)

const strict = false

const modules = {
  vendor
}

const state = {
  transactions: [],
  products: [],
  onError: false,
  product: null
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
