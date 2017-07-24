import {
  INIT_SALDO_TRANSACTIONS
} from 'globalVuexConstant'

export default {
  [INIT_SALDO_TRANSACTIONS] (state, history) {
    state.history = history
  }
}
