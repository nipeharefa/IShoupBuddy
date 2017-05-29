<template>
  <div class="nav-right nav-menu">
      <a class="nav-item is-tab" href="/cart">
        <i class="fa fa-shopping-cart"></i>
      </a>
      <a class="nav-item" href="/me">
        <i class="fa fa-user" aria-hidden="true"></i>
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
