import {
  INIT_ACTIVE_USER,
  SET_ISACTIVE,
  SET_SEARCH_ACTIVE,
  UPDATE_ACTIVE_USER,
  SET_TOTAL_CART,
  WISH_PRODUCT,
  INIT_REVIEWS,
  INIT_REVIEW,
  INIT_REPORT_REVIEWS,
  INIT_CATEGORIES
} from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const updateActiveuser = ({ commit }, user) => {
  commit(UPDATE_ACTIVE_USER, user)
}

export const setIsActive = ({ commit }, status) => {
  commit(SET_ISACTIVE, status)
}

export const setSearchActive = ({ commit }, status) => {
  commit(SET_SEARCH_ACTIVE, status)
}

export const setTotalCart = ({ commit }, total) => {
  commit(SET_TOTAL_CART, total)
}

export const wishProduct = ({ commit }, liked) => {
  commit(WISH_PRODUCT, liked)
}

export const initReviews = ({ commit }, reviews) => {
  commit(INIT_REVIEWS, reviews)
}

export const initReview = ({ commit }, review) => {
  commit(INIT_REVIEW, review)
}

export const initReportReviews = ({ commit }, reports) => {
  commit(INIT_REPORT_REVIEWS, reports)
}

export const initCategories = ({ commit }, categories) => {
  commit(INIT_CATEGORIES, categories)
}
