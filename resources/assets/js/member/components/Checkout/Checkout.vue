<template>
  <div id="application-checkout">
    <section id="navbar">
      <navbarApps />
    </section>
    <section id="content" class="section">
      <div class="container">
        <div class="columns">
          <breadCrumb />
        </div>
        <div class="columns">
          <div class="column is-half"></div>
          <div class="column is-half">
           <div>
              <small>Total Belanja</small>
              <span class="total">Rp. 100.000</span>
           </div>
          </div>
        </div>
      </div>
    </section>
    <section id="footer">
      <footerApps />
    </section>
  </div>
</template>


<script>
  import { mapGetters, mapStates } from 'vuex'
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/MemberNavbar.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')
  export default {
    components: {
      FooterApps,
      NavbarApps,
      BreadCrumb
    },
    computed: {
      ...mapGetters(['activeUser'])
    }
  }
</script>
