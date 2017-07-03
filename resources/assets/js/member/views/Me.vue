<template>
  <div>
    <vue-progress-bar></vue-progress-bar>
    <navbar-apps-member></navbar-apps-member>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <sidebar></sidebar>
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
  const Sidebar = () => import('otherComponents/Sidebar-Member.vue')
  const NavbarAppsMember = () => import('global/components/Navbars/MemberNavbar.vue')

  export default {
    components: {
      FooterApps,
      Sidebar,
      NavbarAppsMember
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
