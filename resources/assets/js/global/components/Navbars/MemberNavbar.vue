<template>
  <navbar>
    <hamburger></hamburger>
    <logo></logo>
    <div slot="right-icon" class="icon-right-wrapper">
      <a @click="setSearchActive(true)">
        <i class="fa fa-search"></i>
      </a>
      <a href="/me">
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
    </div>
    <div slot="mobile-left-drawer" class="container-menu-touch is-hidden-desktop" v-if="isActive">
      <drawer-member></drawer-member>
      <div @click="setIsActive(false)" style="width: 20%"></div>
    </div>
    <right-search slot="search"></right-search>
  </navbar>
</template>

<script>
  const DrawerMember = () => import('./partials/DrawerMember.vue')
  const RightSearch = () => import('./partials/RightSearch.vue')

  const Navbar = () => import('./Navbar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      Navbar,
      DrawerMember,
      RightSearch
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
