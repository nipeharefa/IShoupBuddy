import {
  INIT_SALDO_TRANSACTIONS,
  ADD_SALDO_TRANSACTION,
  INIT_SALDO_TRANSACTION,
  UPDATE_SALDO_TRANSACTION_ATTACHMENT
} from 'globalVuexConstant'

const orderDescById = (a, b) => {
  if (a.id > b.id) {
    return -1
  }

  if (a.id < b.id) {
    return 1
  }

  return 0
}

export default {
  [INIT_SALDO_TRANSACTIONS] (state, history) {
    state.history = history
  },
  [INIT_SALDO_TRANSACTION] (state, history) {
    state.historyDetail = history
  },
  [ADD_SALDO_TRANSACTION] (state, transaction) {
    state.history.push(transaction)
    state.history.sort(orderDescById)
  },
  [UPDATE_SALDO_TRANSACTION_ATTACHMENT] (state, attachmentsObj) {
    state.historyDetail.attachments = attachmentsObj
  }
}
