<template>
  <nav class="nav-model-classic" :class="{'is-active': onActive }">
    <div class="container is-hidden-touch">
      <div class="columns">
        <div class="column">
          <nav class="nav">

            <div class="nav-left">
              <a class="nav-item" href="/">
                <img src="/img/logo/logo-store-64.png" alt="Bulma logo">
              </a>
            </div>
            <div class="nav-right nav-menu">
              <a class="nav-item is-tab" href="/me">
                <figure class="image is-16x16" style="margin-right: 8px;">
                  <img src="/img/logo/logo-store-64.png">
                </figure>
                {{ activeUser.name }}
              </a>
              <a class="nav-item is-tab" @click="logout">Log out</a>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
  import { mapGetters } from 'vuex'
  export default {
    mounted () {
    },
    data () {
      return {
        onActive: false
      }
    },
    compoents: {},
    methods: {
      logout () {
        this.$http.delete('auth/logout').then(response => {
          window.location.assign('/')
        }).catch(err => {
          console.log(err)
        })
      }
    },
    computed: {
      ...mapGetters([
        'activeUser'
      ])
    }
  }
</script>
