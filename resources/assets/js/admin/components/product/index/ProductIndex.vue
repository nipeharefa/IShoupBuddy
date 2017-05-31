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
              <a href="/admin/product/create" class="button is-primary">Tambah Produk</a>
              <br>
              <table-product></table-product>
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
  const TableProduct = () => import('./TableProduct.vue')
  const AdminSidebar = () => import('otherComponents/Sidebars/AdminSidebar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    mounted() {
      this.getProducts()
    },
    components: {
      FooterApps,
      TableProduct,
      AdminSidebar
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    },
    methods: {
      ...mapActions([
        'initProducts'
      ]),
      getProducts () {
        this.$http.get('api/admin/product').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => err)
      }
    }
  }
</script>
