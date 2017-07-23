<template>
  <div class="navbar-end">

    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link link-no-hover-change" href="/me">
        <span class="navbar-user-fullname">
          Hi, {{ activeUser.name }}
        </span>
      </a>

      <div class="navbar-dropdown dropdown-right">
        <a class="navbar-item " href="#" @click="logout">
          Logout
        </a>
      </div>
    </div>

  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'activeUser'
      ])
    },
    methods: {
      logout () {
        console.log('logout')
        this.$http.delete('auth/logout').then(response => {
          window.location.assign('/')
          console.log(response)
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>
