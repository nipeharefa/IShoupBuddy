<template>
  <div>
    <vue-progress-bar></vue-progress-bar>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <vendor-sidebar></vendor-sidebar>
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
  const VendorSidebar = () => import('global/components/Sidebars/VendorSidebar.vue')

  export default {
    components: {
      FooterApps,
      VendorSidebar
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
