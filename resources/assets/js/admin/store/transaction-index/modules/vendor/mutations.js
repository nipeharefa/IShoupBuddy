import { INIT_VENDORS } from 'globalVuexConstant'
export default {
  [INIT_VENDORS] (state, vendors) {
    state.vendors = vendors
  }
}
