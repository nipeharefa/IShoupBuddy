import {
  INIT_TRANSACTIONS
} from 'globalVuexConstant'

export const initTransactions = ({ commit }, transactions) => {
  commit(INIT_TRANSACTIONS, transactions)
}
