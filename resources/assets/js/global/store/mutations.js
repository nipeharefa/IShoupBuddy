export const INIT_ACTIVE_USER = (state, user) => {
  state.activeUser = user
}
export const SET_ISACTIVE = (state, status) => {
  state.isActive = status
}
export const SET_SEARCH_ACTIVE = (state, status) => {
  state.searchActive = status
}

export const UPDATE_ACTIVE_USER = (state, user) => {
  state.activeUser = user
}

export const SET_TOTAL_CART = (state, totalCart) => {
  state.totalCart = totalCart
}

export const WISH_PRODUCT = (state, liked) => {
  state.product.liked = liked
}

export const INIT_REVIEWS = (state, reviews) => {
  state.reviews = reviews
}

export const INIT_REVIEW = (state, review) => {
  state.review = review
}

export const INIT_REPORT_REVIEWS = (state, reports) => {
  state.reportReviews = reports
}
