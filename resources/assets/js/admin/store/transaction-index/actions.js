import { INIT_TRANSACTIONS, INIT_PRODUCTS } from 'globalVuexConstant'
export const initTransactions = ({ commit }, transactions) => {
  commit(INIT_TRANSACTIONS, transactions)
}

export const initProducts = ({ commit }, products) => {
  commit(INIT_PRODUCTS, products)
}
