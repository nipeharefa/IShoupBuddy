<template>
  <div>
    <vue-progress-bar></vue-progress-bar>
    <navbar></navbar>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <admin-sidebar></admin-sidebar>
            </div>
            <div class="column">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const AdminSidebar = () => import('global/components/Sidebars/AdminSidebar.vue')
  const Navbar = () => import('global/components/Navbars/AdminNavbar.vue')

  export default {
    components: {
      FooterApps,
      AdminSidebar,
      Navbar
    },
    created () {
      this.$Progress.start()
    },

    mounted () {
      this.$Progress.finish()
    },

    beforeUpdate () {
      this.$Progress.start()
    },

    updated () {
      this.$Progress.finish()
    }
  }
</script>
