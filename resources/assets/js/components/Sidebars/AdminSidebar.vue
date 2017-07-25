<template>
  <aside class="menu">
    <p class="menu-label">
      General
    </p>
    <ul class="menu-list">
      <li>
        <router-link :to="{ name: 'listCategory' }" append>Kategory</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listProducts' }" append>Produk</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listProducts' }" append>Review</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listTransaction' }" append>Transaksi</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listTransaction' }" append>Konfirmasi PopUp</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listUser' }" append>Pengguna</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'listVendor' }" append>Vendor</router-link>
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
          window.location.assign('/')
        }).catch(err => err)
      }
    }
  }
</script>
