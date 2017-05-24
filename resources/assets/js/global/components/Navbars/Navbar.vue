<template>
  <div>
    <div class="mosqito" v-if="!activeUser">
      <div class="container">
        <ul>
          <li><a href="">Download Aplikasi</a></li>
          <li><a href="/login">Login</a></li>
          <li><a href="/register">Daftar</a></li>
        </ul>
      </div>
    </div>
    <nav  :class="[navClass,{'is-active': isActive }]">
      <div :class="navClassC">
        <hamburger></hamburger>
        <logo></logo>
        <searchBox></searchBox>
        <slot name="right-icon"></slot>
        <slot name="desktop-nav"></slot>
        <rightMenuItem></rightMenuItem>
      </div>

      <slot name="search"></slot>
      <slot name="mobile-left-drawer"></slot>

    </nav>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  const Hamburger = () => import('./partials/Hamburger.vue')
  const Logo = () => import('./partials/Logo.vue')
  const SearchBox = () => import('./partials/SearchBox.vue')
  const RightMenuItem = () => import('./partials/RightMenuItem.vue')

  export default {
    props: {
      navClass: {
        default: 'nav-model-classic'
      },
      navClassC: {
        default: 'wrapper-new-nav is-hidden-desktop'
      }
    },
    components: {
      Hamburger,
      Logo,
      SearchBox,
      RightMenuItem
    },
    computed: {
      ...mapGetters([
        'isActive',
        'activeUser'
      ])
    }
  }
</script>
