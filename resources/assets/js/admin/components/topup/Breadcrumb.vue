<template>
  <nav class="breadcrumb">
    <ul>
      <li><a href="/">Halaman Depan</a></li>
      <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
      </li>
      <li>
        <a class="is-active">Top Up</a>
      </li>
    </ul>
  </nav>
</template>


<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters(['user'])
    }
  }
</script>
