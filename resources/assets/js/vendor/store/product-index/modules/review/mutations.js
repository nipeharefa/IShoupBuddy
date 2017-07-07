import { INIT_REVIEWS, INIT_REVIEW } from 'globalVuexConstant'

export default {

  [INIT_REVIEWS] (state, reviews) {
    state.reviews = reviews
  },
  [INIT_REVIEW] (state, review) {
    state.reviews = review
  }
}
