export const transactions = state => state.transactions.sort((a, b) => {
  if (a.id > b.id) {
    return -1
  }

  if (a.id < b.id) {
    return 1
  }

  return 0
})

export const products = state => state.products
export const onError = state => state.onError
export const product = state => state.product
export const activeUser = state => state.activeUser
export const topup = state => state.transactions.filter(x => {
  return x.type === 'Saldo' && x.debit_credit === 0
}).sort((a, b) => {
  if (a.id > b.id) {
    return -1
  }

  if (a.id < b.id) {
    return 1
  }

  return 0
})
export { isActive, searchActive, reviews, review, reportReviews } from 'gettersStore'
