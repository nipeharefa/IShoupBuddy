<template>
  <navbar>
    <rightMenuVendor slot="navbar-end"/>
  </navbar>
</template>

<script>

  const RightMenuVendor = () => import('./partials/RightMenuVendor.vue')

  const Navbar = () => import('./Navbar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      Navbar,
      RightMenuVendor
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
