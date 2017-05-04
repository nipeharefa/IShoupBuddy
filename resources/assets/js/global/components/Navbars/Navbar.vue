<template>
  <nav  :class="[navClass,{'is-active': isActive }]">
    <div :class="navClassC">
      <hamburger></hamburger>
      <logo></logo>
      <slot name="right-icon"></slot>
    </div>

    <slot name="search"></slot>
    <slot name="mobile-left-drawer"></slot>

  </nav>
</template>


<script>
  import { mapGetters } from 'vuex'

  const Hamburger = () => import('./partials/Hamburger.vue')
  const Logo = () => import('./partials/Logo.vue')

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
      Logo
    },
    computed: {
      ...mapGetters([
        'isActive'
      ])
    }
  }
</script>
