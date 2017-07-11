import { INIT_ACTIVE_USER, INIT_PRODUCT, INIT_RECOMMENDATION_PRODUCTS } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}
export const initProduct = ({ commit }, product) => {
  commit(INIT_PRODUCT, product)
}

export const initRecommendationProducts = ({ commit }, products) => {
  commit(INIT_RECOMMENDATION_PRODUCTS, products)
}

export { setIsActive, setSearchActive, setTotalCart, wishProduct } from 'actionsStore'
