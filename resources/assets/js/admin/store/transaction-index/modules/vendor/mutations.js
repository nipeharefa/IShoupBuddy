import { INIT_VENDORS, INIT_VENDOR } from 'globalVuexConstant'
export default {
  [INIT_VENDORS] (state, vendors) {
    state.vendors = vendors
  },
  [INIT_VENDOR] (state, vendor) {
    state.vendor = vendor
  }
}
