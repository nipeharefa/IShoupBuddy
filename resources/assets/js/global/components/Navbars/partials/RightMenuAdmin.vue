<template>
  <div class="nav-right nav-menu">
      <div class="user_info">
        <a class="nav-item" href="/admin">
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <span>Hi</span>
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
