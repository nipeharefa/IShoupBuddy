import { INIT_TRANSACTIONS, INIT_PRODUCTS, INIT_PRODUCT } from 'globalVuexConstant'
export const initTransactions = ({ commit }, transactions) => {
  commit(INIT_TRANSACTIONS, transactions)
}

export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}

export const initProduct = ({ commit }, product) => {
  commit(INIT_PRODUCT, product)
}
