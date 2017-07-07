import {
  INIT_VENDORS,
  INIT_VENDOR,
  UPDATE_VENDOR,
  CONFIRM_VENDOR
} from 'globalVuexConstant'
export default {
  [INIT_VENDORS] (state, vendors) {
    state.vendors = vendors
  },
  [INIT_VENDOR] (state, vendor) {
    state.vendor = vendor
  },
  [UPDATE_VENDOR] (state, data) {
    state.vendors[data.index] = data.vendor
  },
  [CONFIRM_VENDOR] (state, index) {
    state.vendors[index]['confirmed'] = true
  }
}
