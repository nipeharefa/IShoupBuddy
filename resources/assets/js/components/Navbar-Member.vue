<template>
  <nav class="nav-model-classic" :class="{'is-active': onActive }">

    <div class="wrapper-new-nav">

      <div class="logo">

       <a href="#">
        <img src="/img/logo/logo-store-64.png" alt="logo" class="logo-inline">
       </a>

      </div>

      <div class="icon-wrapper" @click="putar">
        <i class="fa fa-sort-down default-caret" :class="{'caret-is-active': onActive }"></i>
      </div>

    </div>

    <div class="container-menu-touch"
       :class="{'is-active': onActive }">

     <div class="menu-touch"
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
  .logo-inline {
    width: 32px;
    height: 32px;
  }
</style>

<!-- <div>Icons made by <a href="http://www.flaticon.com/authors/madebyoliver" title="Madebyoliver">Madebyoliver</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
