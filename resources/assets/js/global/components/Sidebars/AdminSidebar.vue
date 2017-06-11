<template>
  <aside class="menu">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'listProducts' }" append>Products</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listReview' }" append>Review</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listTransaction' }" append>Transactions</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listUser' }" append>Users</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listVendor' }" append>Vendors</router-link>
      </li>
    </ul>
    <p class="menu-label">
      Settings
    </p>
    <ul class="menu-list">
      <li><a @click="logout">Logout</a></li>
    </ul>
  </aside>
</template>



<script>
  export default {
    methods: {
      logout () {
        this.$http.delete('admin/logout').then(response => {
          window.location.assign('/admin/login')
        }).catch(err => err)
      }
    }
  }
</script>
