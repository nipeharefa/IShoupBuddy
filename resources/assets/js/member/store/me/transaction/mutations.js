import {
  INIT_TRANSACTIONS,
  INIT_TRANSACTION,
  UPDATE_TRANSACTION
} from 'globalVuexConstant'

export default {
  [INIT_TRANSACTIONS] (state, transactions) {
    state.transactions = transactions
  },
  [INIT_TRANSACTION] (state, transaction) {
    state.transaction = transaction
  },
  [UPDATE_TRANSACTION] (state, obj) {
    state.transactions.splice(obj.index, 1, obj.data)
  }
}
