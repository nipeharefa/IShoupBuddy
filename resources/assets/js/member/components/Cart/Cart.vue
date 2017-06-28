<template>
  <div id="sub-apps">
    <div>
      <navbar />
    </div>
    <section class="section">
      <div class="container">
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')

  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      Navbar,
      FooterApps
    }
  }
</script>
