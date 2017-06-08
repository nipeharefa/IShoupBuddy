import { INIT_VENDORS, INIT_VENDOR } from 'globalVuexConstant'
export const initVendors = ({ commit }, vendors) => {
  commit(INIT_VENDORS, vendors)
}

export const initProduct = ({ commit }, vendor) => {
  commit(INIT_VENDOR, vendor)
}
