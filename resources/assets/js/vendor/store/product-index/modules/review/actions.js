import { INIT_REVIEWS, INIT_REVIEW } from 'globalVuexConstant'

export const initReviews = ({ commit }, reviews) => {
  commit(INIT_REVIEWS, reviews)
}

export const initReview = ({ commit }, review) => {
  commit(INIT_REVIEW, review)
}
