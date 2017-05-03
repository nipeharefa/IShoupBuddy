<template>
  <div>
    <div class="nav">
      <div class="container">

        <div class="is-hidden-desktop">
          <span class="nav-toggle" :class="{'is-active': openedNav }" @click="openNav">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>

        <div class="nav-left">
          <a href="/" class="nav-item">
            <img src="/img/logo/logo-store-64.png" alt="logo" class="logo-inline">
          </a>
        </div>

        <div class="nav-center is-hidden-touch">
          <a class="nav-item">
            <div class="field has-addons">
              <p class="control akumaubelanja">
                <input class="input" type="text" placeholder="Aku mau cari.." role="search" @keyup.enter="doSearch" v-model="keyword">
              </p>
              <p class="control">
                <a class="button" @click="doSearch">
                  <i class="fa fa-search"></i>
                </a>
              </p>
            </div>
          </a>
        </div>

        <div class="guest-icon-navbar-right is-hidden-desktop">
          <a>
            <i class="fa fa-search" @click="openSearchView"></i>
          </a>
          <a href="/login">
            <i class="fa fa-sign-in"></i>
          </a>
          <a>
            <i class="fa fa-shopping-cart"></i>
          </a>
        </div>

          <div class="nav-right nav-menu" :class="{'is-active': openedNav }">
              <a class="nav-item is-tab" href="/cart">
                <i class="fa fa-shopping-cart"></i>
              </a>
              <a class="nav-item is-tab" href="/login">Login</a>
              <a class="nav-item is-tab" href="/register">
                <!-- <button class="button">Register</button> -->
                <span class="register-button">Register</span>
              </a>
          </div>

      </div>


    </div>

    <div class="rightnav-guest-search is-hidden-desktop" v-if="searchView" >
      <div class="search-mobile-wrapper">
        <i class="fa fa-arrow-left" @click="openSearchView"></i>
        <input type="text" class="control" placeholder="Cari produk..." @keyup.enter="doSearch" v-model="keyword">
      </div>
    </div>

    <transition name="fade">
      <div class="sidenav-guest is-hidden-desktop" v-if="sidenav" @click="openNav">
        <div class="wrapper-sidenav">
          <ul>
            <li>
              <a href="/login">
                <i class="fa fa-sign-in"></i>
                <small>Login</small>
              </a>
            </li>
            <li>
              <a href="">
                <i class="fa fa-list"></i>
                <small>Kategori</small>
              </a>
            </li>
            <li>
              <a href="/help">
                <i class="fa fa-question"></i>
                <small>Bantuan</small>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </transition>

  </div>
</template>

<script>
  export default {
    data () {
      return {
        openedNav: false,
        keyword: '',
        sidenav: false,
        searchView: false
      }
    },
    methods: {
      doSearch () {
        window.location.assign(`/search?q=${this.keyword}`)
      },
      openSearchView () {
        this.searchView = !this.searchView
      },
      openNav () {
        this.sidenav = !this.sidenav
      }
    }
  }
</script>
