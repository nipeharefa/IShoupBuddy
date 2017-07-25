import {
  INIT_SALDO_TRANSACTIONS,
  ADD_SALDO_TRANSACTION,
  INIT_SALDO_TRANSACTION,
  UPDATE_SALDO_TRANSACTION_ATTACHMENT
} from 'globalVuexConstant'

export default {
  [INIT_SALDO_TRANSACTIONS] (state, history) {
    state.history = history
  },
  [INIT_SALDO_TRANSACTION] (state, history) {
    state.historyDetail = history
  },
  [ADD_SALDO_TRANSACTION] (state, transaction) {
    state.history.push(transaction)
  },
  [UPDATE_SALDO_TRANSACTION_ATTACHMENT] (state, attachmentsObj) {
    state.historyDetail.attachments = attachmentsObj
  }
}
