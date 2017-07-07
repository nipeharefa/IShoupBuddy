<template>
  <div class="nav-right nav-menu">
      <div class="user_info">
        <a class="nav-item" href="/vendor/product">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="user_name">Hi, {{activeUser.name}}</span>
        </a>
      </div>
  </div>
</template>

<style lang="scss" scoped>
  span.user_name {
    font-size: 0.8rem;
    margin-left: 0.4rem;
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
