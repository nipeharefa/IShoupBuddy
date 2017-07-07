import {
  INIT_VENDORS,
  INIT_VENDOR,
  UPDATE_VENDOR,
  CONFIRM_VENDOR
} from 'globalVuexConstant'

export const initVendors = ({ commit }, vendors) => {
  commit(INIT_VENDORS, vendors)
}

export const initProduct = ({ commit }, vendor) => {
  commit(INIT_VENDOR, vendor)
}

export const updateVendor = ({ commit }, data) => {
  commit(UPDATE_VENDOR, data)
}

export const confirmVendor = ({ commit }, index) => {
  commit(CONFIRM_VENDOR, index)
}
