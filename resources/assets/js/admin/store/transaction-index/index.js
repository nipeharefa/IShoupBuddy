import Vue from 'vue'
import Vuex from 'vuex'

import * as actions from './actions'
import * as getters from './getters'
import mutations from './mutations'
import vendor from './modules/vendor'
import user from './modules/user'
import category from './modules/category'
import { isActive, searchActive, activeUser, reviews, review, reportReviews } from 'statesStore'
Vue.use(Vuex)

const strict = false

const modules = {
  vendor,
  user,
  category
}

const state = {
  transactions: [],
  products: [],
  onError: false,
  product: null,
  isActive,
  searchActive,
  activeUser,
  reviews,
  review,
  reportReviews
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
