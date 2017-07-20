export const activeUser = state => state.activeUser
export const carts = state => state.carts.carts || null
export const cartsTotal = state => state.carts.total
export const cartsTotalString = state => state.carts.total_string

export {
  isActive,
  searchActive,
  totalCart,
  categories
} from 'gettersStore'
