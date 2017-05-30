<template>
  <div class="apps-container">
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-one-quarter">
            <admin-sidebar></admin-sidebar>
          </div>

          <div class="column">
            <div class="columns">
              <formEditProduct v-if="product"/>
            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="section footer_section">
      <footer-apps></footer-apps>
    </section>
  </div>
</template>


<script>

  const FooterApps = () => import('otherComponents/Footer.vue')
  const AdminSidebar = () => import('otherComponents/Sidebars/AdminSidebar.vue')
  const FormEditProduct = () => import('./FormEditProduct.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      FooterApps,
      AdminSidebar,
      FormEditProduct
    },
    computed: {
      ...mapGetters([
        'product'
      ])
    },
    methods: {}
  }
</script>
