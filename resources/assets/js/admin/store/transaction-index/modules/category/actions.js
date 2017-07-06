import {
  INIT_CATEGORIES, INIT_CATEGORY,
  DELETE_CATEGORY, ADD_CATEGORY
} from 'globalVuexConstant'

export const initCategories = ({ commit }, categories) => {
  commit(INIT_CATEGORIES, categories)
}

export const addCategory = ({ commit }, category) => {
  commit(ADD_CATEGORY, category)
}

export const initCategory = ({ commit }, category) => {
  commit(INIT_CATEGORY, category)
}

export const deleteCategory = ({ commit }, indexOf) => {
  commit(DELETE_CATEGORY, indexOf)
}
