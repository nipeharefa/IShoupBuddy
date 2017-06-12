import { INIT_CATEGORIES, INIT_CATEGORY } from 'globalVuexConstant'
export const initCategories = ({ commit }, categories) => {
  commit(INIT_CATEGORIES, categories)
}

export const initCategory = ({ commit }, category) => {
  commit(INIT_CATEGORY, category)
}
