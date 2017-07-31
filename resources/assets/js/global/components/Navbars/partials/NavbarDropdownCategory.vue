<template>
  <div class="navbar-item has-dropdown is-hoverable dropdown-category no-hover-change">
    <a class="navbar-link no-hover-change" href="#">
      Kategori
    </a>
    <div class="navbar-dropdown ">
      <a href="/c/uncategorized" class="navbar-item">Semua Kategori</a>
      <hr class="dropdown-divider">
      <a class="navbar-item " :href="`/c/${item.slug}`"
      v-for="item in categories" v-if="categories">
        {{ item.name }}
      </a>
    </div>
  </div>
</template>



<script>
  import { mapGetters } from 'vuex'

  export default {
    created () {
      let categories = window._sharedData.categories
      this.categories = categories.filter(x => {
        return x.slug !== 'uncategorized'
      })
    },
    data () {
      return {
        categories: null
      }
    }
  }
</script>
