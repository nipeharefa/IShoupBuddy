export const transactions = state => state.transactions
export const products = state => state.products
export const onError = state => state.onError
export const product = state => state.product
export const activeUser = state => state.activeUser
export const topup = state => state.transactions.filter(x => {
  return x.type === 'Saldo' && x.debit_credit === 0
})
export { isActive, searchActive, reviews, review, reportReviews } from 'gettersStore'
