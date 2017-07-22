<template>
  <navbar>
    <rightMenuMember slot="navbar-end"/>
  </navbar>
</template>

<script>
  const RightMenuMember = () => import('./partials/RightMenuMember.vue')
  const Navbar = () => import('./Navbar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      Navbar,
      RightMenuMember
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
