import { SET_ON_ERROR } from 'globalVuexConstant'
export const setOnError = ({ commit }, error) => {
  commit(SET_ON_ERROR, error)
}
