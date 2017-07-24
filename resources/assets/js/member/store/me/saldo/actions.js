import {
  INIT_SALDO_TRANSACTIONS
} from 'globalVuexConstant'

export const initSaldoTransactions = ({ commit }, transactions) => {
  commit(INIT_SALDO_TRANSACTIONS, transactions)
}
