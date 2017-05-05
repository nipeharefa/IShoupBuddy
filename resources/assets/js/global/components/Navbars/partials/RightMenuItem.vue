<template>
  <div class="nav-right nav-menu">
      <a class="nav-item is-tab" href="/cart">
        <i class="fa fa-shopping-cart"></i>
      </a>
      <a class="nav-item is-tab" href="/login" v-if="guest">Login</a>
      <a class="nav-item is-tab" href="/register" v-if="guest">
        <span class="register-button">Register</span>
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
