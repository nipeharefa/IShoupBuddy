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
              <br>
              <table-vendor :vendors="vendors"></table-vendor>
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
  const TableVendor = () => import('./TableVendor.vue')

  export default {
    components: {
      FooterApps,
      AdminSidebar,
      TableVendor
    },
    mounted () {
      this.getVendors()
    },
    data () {
      return {
        vendors: []
      }
    },
    methods: {
      getVendors () {

        this.$http.get('api/vendor').then(response => {
          this.vendors = response.data.vendors
        }).catch(err => err)
      }
    }
  }
</script>
