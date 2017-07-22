<template>
  <navbar>
    <div class="navbar-end" slot="navbar-end">
      <rightMenuGuest />
    </div>
  </navbar>
</template>


<script>
  const Navbar = () => import('./Navbar.vue')
  const RightMenuGuest = () => import('./partials/RightMenuGuest.vue')
  export default {
    components: {
      Navbar,
      RightMenuGuest
    }
  }
</script>
