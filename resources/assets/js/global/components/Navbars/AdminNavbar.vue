<template>
  <navbar>
    <rightMenuAdmin slot="navbar-end"/>
  </navbar>
</template>

<script>
  const Navbar = () => import('./Navbar.vue')
  const RightMenuAdmin = () => import('./partials/RightMenuAdmin.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      Navbar,
      RightMenuAdmin
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
