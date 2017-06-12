import { INIT_CATEGORIES, INIT_CATEGORY } from 'globalVuexConstant'
export default {
  [INIT_CATEGORIES] (state, categories) {
    state.categories = categories
  },
  [INIT_CATEGORY] (state, category) {
    state.category = category
  }
}
