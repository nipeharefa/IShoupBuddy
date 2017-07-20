const GetCategory = {
  install (Vue, options) {
    Vue.mixin({
      created: function () {
        this.$getCategory()
      }
    })
    Vue.prototype.$getCategory = function () {
      this.$http.get(`/api/category`).then(response => {
        this.$store.commit('INIT_CATEGORIES', response.data.categories)
      }).catch(err => err)
    }
  }
}

export default GetCategory
