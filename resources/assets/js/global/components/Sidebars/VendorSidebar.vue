<template>
  <aside class="menu">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'dashboard' }" append>Dashboard</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'product-index' }" append>Produk</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'review-index' }" append>Review</router-link>
      </li>
    </ul>
    <p class="menu-label">
      Settings
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'change-profile' }" append>Change Profile</router-link>
      </li>
      <li><a @click="logout">Logout</a></li>
    </ul>
  </aside>
</template>


<script>
  export default {
    methods: {
      logout () {
        this.$http.delete('auth/vendor/logout').then(response => {
          window.location.assign('/')
        }).catch(err => err)
      }
    }
  }
</script>
