<template>
  <div>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <admin-sidebar></admin-sidebar>
            </div>
            <div class="column">
              <vue-progress-bar></vue-progress-bar>
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
  const AdminSidebar = () => import('otherComponents/Sidebars/AdminSidebar.vue')

  export default {
    components: {
      FooterApps,
      AdminSidebar
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
