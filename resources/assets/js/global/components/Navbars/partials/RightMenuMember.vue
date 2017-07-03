<template>
  <div class="nav-right nav-menu">
      <a class="nav-item is-tab" href="/cart">
        <i class="fa fa-shopping-cart white" aria-hidden="true"></i>
      </a>
      <div class="user_info">
        <a class="nav-item" href="/me">
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <span>Hi, {{activeUser.name}}</span>
      </div>
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
