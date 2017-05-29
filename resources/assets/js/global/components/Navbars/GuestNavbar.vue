<template>
  <navbar :navClass="'nav'" :navClassC="'container'">
    <hamburger></hamburger>
    <logo></logo>
    <div slot="right-icon" class="guest-icon-navbar-right is-hidden-desktop">
      <a @click="setSearchActive(true)">
        <i class="fa fa-search"></i>
      </a>
      <a href="/login">
        <i class="fa fa-sign-in"></i>
      </a>
      <a>
        <i class="fa fa-shopping-cart"></i>
      </a>
    </div>
    <div slot="mobile-left-drawer" class="sidenav-guest is-hidden-desktop" v-if="isActive">
      <guest-drawer></guest-drawer>
      <div @click="setIsActive(false)" style="width: 20%"></div>
    </div>
    <right-search slot="search"></right-search>
    <rightMenuItem slot="rightmenu" />
  </navbar>
</template>

<script>

  const RightSearch = () => import('./partials/RightSearch.vue')
  const GuestDrawer = () => import('./partials/GuestDrawer.vue')
  const RightMenuItem = () => import('./partials/RightMenuItem.vue')

  const Navbar = () => import('./Navbar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      Navbar,
      RightSearch,
      GuestDrawer,
      RightMenuItem
    },
    computed: {
      ...mapGetters([
        'isActive',
        'searchActive'
      ])
    },
    methods: {
      ...mapActions([
        'setIsActive',
        'setSearchActive'
      ])
    }
  }
</script>
