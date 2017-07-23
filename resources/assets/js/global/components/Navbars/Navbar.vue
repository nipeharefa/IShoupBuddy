<template>
  <div class="navbar-wrapper">
    <div class="container">
      <nav class="navbar ">
        <div class="navbar-brand">
          <div class="navbar-burger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <a class="navbar-item no-hover-change" href="/">
            <img src="/img/logo/logo-store-64.png" alt="logo" class="logo-inline">
          </a>
        </div>
        <div id="navbarDesktop" class="navbar-menu">

          <div class="navbar-start">
            <navbarDropdownCategory :categories="sortedCategory" />
            <div class="navbar-item">
              <div class="field has-addons">
                <p class="control has-icons-left long-searchbox">
                  <span class="icon is-small is-left">
                    <i class="fa fa-search"></i>
                  </span>
                  <input type="text"  class="input"
                  placeholder="Search..." v-model="q" @keyup.enter="search">
                </p>
                <p class="control">
                  <span class="select">
                    <select v-model="category_id">
                      <option value="">Semua Kategori</option>
                      <option :value="item.id" v-for="item in sortedCategory">{{ item.name }}</option>
                    </select>
                  </span>
                </p>
                <p class="control">
                  <a class="button is-info" @click="search">
                    Search
                  </a>
                </p>
              </div>
            </div>
          </div>

          <slot name="navbar-end"></slot>

        </div>
      </nav>
    </div>
  </div>
</template>


<script>
  const NavbarDropdownCategory = () => import('./partials/NavbarDropdownCategory.vue')
  import { mapGetters } from 'vuex'

  export default {
    created () {
      this.getCategory()
    },
    components: {
      NavbarDropdownCategory
    },
    computed: {
      sortedCategory () {
        if (this.categories) {
          const sorted =  this.categories.sort( (a,b) => {
            var nameA = a.name.toUpperCase(); // ignore upper and lowercase
            var nameB = b.name.toUpperCase(); // ignore upper and lowercase
            if (nameA < nameB) {
              return -1;
            }
            if (nameA > nameB) {
              return 1;
            }
            // names must be equal
            return 0;
          })
          return sorted
        }
        return []
      }
    },
    data () {
      return {
        categories: null,
        q: "",
        category_id: ""
      }
    },
    methods: {
      getCategory () {
        this.$http.get('api/category').then(response => {
          this.categories = response.data.categories
        })
      },
      search () {
        window.location.assign(`/search?q=${this.q}&category_id=${this.category_id}`)
      }
    }
  }
</script>
