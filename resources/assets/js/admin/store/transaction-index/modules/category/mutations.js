import { INIT_CATEGORIES, INIT_CATEGORY, DELETE_CATEGORY, ADD_CATEGORY } from 'globalVuexConstant'
export default {
  [INIT_CATEGORIES] (state, categories) {
    state.categories = categories
  },
  [INIT_CATEGORY] (state, category) {
    state.category = category
  },
  [DELETE_CATEGORY] (state, indexOf) {
    state.categories.splice(indexOf, 1)
  },
  [ADD_CATEGORY] (state, data) {
    state.categories.push(data)
  }
}
