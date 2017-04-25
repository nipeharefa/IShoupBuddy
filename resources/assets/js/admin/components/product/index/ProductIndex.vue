<template>
  <div>
    <div>
      <section class="section">
        <div class="container">
          <a href="/admin/product/create" class="button is-primary">Tambah Produk</a>
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
  export default {
    components: {
      FooterApps
    }
  }
</script>
