<template>
  <nav class="nav-model-classic" :class="{'is-active': onActive }">

    <div class="wrapper-new-nav is-hidden-desktop">

      <div class="left-hamburger">

        <div class="logo">
          <a href="#">
            <img src="/img/logo/logo-store-64.png" alt="logo" class="logo-inline">
          </a>
        </div>

        <div class="icon-wrapper" @click="putar" :class="{'is-active': onActive }">
          <i class="fa fa-sort-down default-caret" :class="{'caret-is-active': onActive }"></i>
        </div>

      </div>

      <div class="icon-right-wrapper">
        <a href="/me">
          <i class="fa fa-user" aria-hidden="true"></i>
        </a>
        <a href="/cart">
          <i class="fa fa-shopping-cart fa-6" aria-hidden="true"></i>
        </a>
      </div>

    </div>

    <div class="container-menu-touch is-hidden-desktop" :class="{'is-active': onActive }">

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
                  <img src="http://bulma.io/images/jgthms.png">
                </figure>
                John Doe
              </a>
              <a class="nav-item is-tab">Log out</a>
            </div>

          </nav>
        </div>
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
