import { INIT_ACTIVE_USER } from 'globalVuexConstant'

export const initActiveUser = ({ commit }, user) => {
  commit(INIT_ACTIVE_USER, user)
}

export {
  setTotalCart,
  setIsActive,
  setSearchActive,
  updateActiveuser,
  initCategories
} from 'actionsStore'
