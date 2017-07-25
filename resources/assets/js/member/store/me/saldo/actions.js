import {
  INIT_SALDO_TRANSACTIONS,
  ADD_SALDO_TRANSACTION,
  INIT_SALDO_TRANSACTION,
  UPDATE_SALDO_TRANSACTION_ATTACHMENT
} from 'globalVuexConstant'

export const initSaldoTransactions = ({ commit }, transactions) => {
  commit(INIT_SALDO_TRANSACTIONS, transactions)
}

export const addSaldoTransaction = ({ commit }, transaction) => {
  commit(ADD_SALDO_TRANSACTION, transaction)
}

export const initSaldoTransactionsDetail = ({ commit }, transaction) => {
  commit(INIT_SALDO_TRANSACTION, transaction)
}

export const updateAttachmentTransactionDetail = ({ commit }, attachments) => {
  commit(UPDATE_SALDO_TRANSACTION_ATTACHMENT, attachments)
}
