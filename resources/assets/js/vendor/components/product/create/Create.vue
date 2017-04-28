<template>
  <div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-one-quarter">
            <vendor-sidebar></vendor-sidebar>
          </div>
          <form-create></form-create>
        </div>
      </div>
    </section>

    <div>
      <footer-apps></footer-apps>
    </div>

  </div>
</template>

<script>
  const FormCreate = () => import('./FormCreateProduct.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const VendorSidebar = () => import('otherComponents/Sidebars/VendorSidebar.vue')

  export default {
    components: {
      FormCreate,
      FooterApps,
      VendorSidebar
    }
  }
</script>
