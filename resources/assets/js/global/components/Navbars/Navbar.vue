<template>
  <nav class="nav-model-classic" :class="{'is-active': isActive }">
    <div class="wrapper-new-nav is-hidden-desktop">
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
