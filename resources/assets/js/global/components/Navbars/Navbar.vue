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
            <navbarDropdownCategory />
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
                      <option :value="item.id" v-for="item in categories">{{ item.name }}</option>
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
      this.categories = window._sharedData.categories
    },
    components: {
      NavbarDropdownCategory
    },
    computed: {
    },
    data () {
      return {
        categories: null,
        q: "",
        category_id: ""
      }
    },
    methods: {
      search () {
        window.location.assign(`/search?q=${this.q}&category_id=${this.category_id}`)
      }
    }
  }
</script>
