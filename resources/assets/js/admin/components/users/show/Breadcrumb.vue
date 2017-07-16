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
        <router-link :to="{ name: 'listUser' }" append>
          User
        </router-link>
      </li>
      <li>
        <a class="is-active">{{ user.name }}</a>
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
