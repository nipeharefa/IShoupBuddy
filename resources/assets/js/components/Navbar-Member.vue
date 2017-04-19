<template>
  <nav class="nav-model-classic" :class="{'is-active': onActive }">

    <div class="wrapper-new-nav">

      <div class="logo">

       <a href="http://placehold.it">
        <img src="http://placehold.it/32x32" alt="logo">
       </a>

      </div>

      <div class="icon-wrapper" @click="putar">
        <i class="fa fa-sort-down default-caret" :class="{'caret-is-active': onActive }"></i>
      </div>

    </div>

    <div class="container-menu-touch"
       :class="{'is-active': onActive }">

     <div class="menu-touch" v-if="onActive"
      role="menu">

        <ul class="menu-list">
          <li>
            <a href="/me">Dashboard</a>
          </li>
          <li>
            <a href="/me/change_password">Tukar Password</a>
          </li>
          <li>
            <a href="/me/product_favorite">Barang Favorit</a>
          <li>
            <a href="/me/transactions">Daftar Transaksi</a>
          </li>
          <li>
            <hr>
          </li>
          <li><a>Logout</a></li>
        </ul>

      </div>

    </div>

  </nav>
</template>

<script>
  export default {
    data () {
      return {
        onActive: false
      }
    },
    methods: {
      putar () {
        this.onActive = !this.onActive
      }
    }
  }
</script>


<style lang="scss">

</style>
