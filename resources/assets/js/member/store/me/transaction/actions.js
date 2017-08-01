import {
  INIT_TRANSACTIONS,
  INIT_TRANSACTION,
  UPDATE_TRANSACTION
} from 'globalVuexConstant'

export const initTransactions = ({ commit }, transactions) => {
  commit(INIT_TRANSACTIONS, transactions)
}

export const initTransaction = ({ commit }, transaction) => {
  commit(INIT_TRANSACTION, transaction)
}

export const updateTransaction = ({ commit }, obj) => {
  console.log('adsfasdf')
  commit(UPDATE_TRANSACTION, obj)
}
