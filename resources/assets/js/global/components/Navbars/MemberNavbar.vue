<template>
  <navbar :navClass="'nav nav-model-classic'" :navClassC="'container wrapper-new-nav'">
    <hamburger></hamburger>
    <logo></logo>
    <div slot="right-icon" class="icon-right-wrapper is-hidden-desktop">
      <a @click="setSearchActive(true)">
        <i class="fa fa-search"></i>
      </a>
      <a href="/me">
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
      <a href="#">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </a>
    </div>
    <div slot="mobile-left-drawer" class="container-menu-touch is-hidden-desktop" v-if="isActive">
      <drawer-member></drawer-member>
      <div @click="setIsActive(false)" style="width: 20%"></div>
    </div>
    <right-search slot="search"></right-search>
    <right-menu-item slot="rightmenu"></right-menu-item>
  </navbar>
</template>

<script>

  const DrawerMember = () => import('./partials/DrawerMember.vue')
  const RightSearch = () => import('./partials/RightSearch.vue')
  const Navbar = () => import('./Navbar.vue')
  const RightMenuItem = () => import('./partials/RightMenuMember.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    created () {
      const id = this.activeUser.id
      const echo = this.$echo.private(`saldo.user.${id}`)
                    .listen('SaldoNominalUpdated', (payload) => {
                      console.log(payload)
                  })
    },
    components: {
      Navbar,
      DrawerMember,
      RightSearch,
      RightMenuItem
    },
    computed: {
      ...mapGetters([
        'isActive',
        'searchActive',
        'activeUser'
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
