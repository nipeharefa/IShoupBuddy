import {
  INIT_TRANSACTIONS, INIT_PRODUCTS,
  INIT_PRODUCT, INIT_ACTIVE_USER,
  UPDATE_PRODUCT
} from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export const initTransactions = ({ commit }, transactions) => {
  commit(INIT_TRANSACTIONS, transactions)
}

export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}

export const initProduct = ({ commit }, product) => {
  commit(INIT_PRODUCT, product)
}

export const updateProduct = ({ commit }, data) => {
  commit(UPDATE_PRODUCT, data)
}

export { setIsActive, setSearchActive, initReviews, initReview } from 'actionsStore'
