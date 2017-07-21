<template>
  <div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link  is-active" href="/documentation/overview/start/">
      Kategori
    </a>
    <div class="navbar-dropdown ">
      <a class="navbar-item " href="/documentation/overview/start/" v-for="item in categoriesSorted">
        {{ item.name }}
      </a>
    </div>
  </div>
</template>



<script>
  import { mapGetters } from 'vuex'

  export default {
    props: {
      categories: {
        required: true
      }
    },
    computed: {
      categoriesSorted () {
        const sortedProduct =  this.categories.sort( (a,b) => {
          var nameA = a.name.toLowerCase()
          var nameB = b.name.toLowerCase()
          if (nameA < nameB) {
            return -1;
          }
          if (nameA > nameB) {
            return 1;
          }

          // names must be equal
          return 0;
        })
        return sortedProduct
      }
    }
  }
</script>
