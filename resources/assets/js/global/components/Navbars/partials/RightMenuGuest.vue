<template>
  <div class="nav-right nav-menu ">
      <a href="/login" class="navbar-item no-hover-change">
        Login
      </a>
      <a href="/register" class="navbar-item no-hover-change">
        <button class="button">Register</button>
      </a>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'activeUser'
      ]),
      guest () {
        return this.activeUser === null
      }
    }
  }
</script>
