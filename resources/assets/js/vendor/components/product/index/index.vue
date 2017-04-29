<template>
  <div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-one-quarter">
            <vendor-sidebar></vendor-sidebar>
          </div>
          <div class="column">
            <a class="is-link" href="create">Tambah Produk</a>
            <table-product :role="'vendor'"
              :deleteUrl="'api/product-vendor'"></table-product>
          </div>
        </div>
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>

  const FooterApps = () => import('otherComponents/Footer.vue')
  const VendorSidebar = () => import('otherComponents/Sidebars/VendorSidebar.vue')
  const TableProduct = () => import('adminComponents/product/index/TableProduct.vue')

  import { mapActions } from 'vuex'
  export default {
    mounted() {
      this.getProducts();
    },
    components: {
      FooterApps,
      VendorSidebar,
      TableProduct
    },
    methods: {
      ...mapActions([
        'initProducts'
      ]),
      getProducts () {
        this.$http.get('api/product-vendor').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => err);
      }
    }
  }
</script>
