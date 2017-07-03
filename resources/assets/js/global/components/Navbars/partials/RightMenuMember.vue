<template>
  <div class="nav-right nav-menu">
      <a class="nav-item is-tab" href="/cart">
        <i class="fa fa-shopping-cart white" aria-hidden="true"></i>
      </a>
      <div class="user_info">
        <a class="nav-item" href="/me">
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <span class="user_name">Hi, {{activeUser.name}}</span>
      </div>
  </div>
</template>

<style lang="scss" scoped>
  span.user_name {
    font-size: 0.8rem;
  }
</style>

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
