<template>
  <div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link  is-active" href="/documentation/overview/start/">
      Kategori
    </a>
    <div class="navbar-dropdown ">
      <a class="navbar-item " href="/documentation/overview/start/" v-for="item in categories">
        {{ item.name }}
      </a>
    </div>
  </div>
</template>



<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'categories'
      ])
    }
  }
</script>
