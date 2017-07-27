<template>
  <div class="navbar-item has-dropdown is-hoverable dropdown-category no-hover-change">
    <a class="navbar-link no-hover-change" href="#">
      Kategori
    </a>
    <div class="navbar-dropdown ">
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
      this.categories = window._sharedData.categories
    },
    data () {
      return {
        categories: null
      }
    }
  }
</script>
