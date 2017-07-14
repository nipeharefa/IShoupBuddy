<template>
  <div class="user-informations">
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
    <div class="user-informations__head">
      <h3 class="title is-4">Informasi User - #{{ user.id }}</h3>
    </div>
    <div class="user-informations__body">
      <img :src="user.picture_urls.small" alt="" class="user-profile__image">
      <div class="user_informations__right">
        <p class="user__fullname">{{ user.name }}</p>
        <p class="user__email">{{ user.email }}</p>
        <p class="user__address"></p>
      </div>
    </div>
    <div class="user-reviews"></div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    created () {
      this.getUsers()
    },
    computed: {
      ...mapGetters([
        'users',
        'user'
      ])
    },
    methods: {
      ...mapActions([
        'initUser'
      ]),
      getUsers () {
        const id = this.$route.params.id

        const indexUser = this.users.findIndex( x => id == x.id)

        this.initUser(this.users[indexUser])
      }
    }
  }
</script>
