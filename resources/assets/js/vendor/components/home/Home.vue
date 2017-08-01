<template>
  <div id="sub-apps-member">
    <div>
      <navbar></navbar>
    </div>
    <section class="section">
      <div class="container">
        <h3 class="product-list-caption">Produk Terbaru</h3>
        <list-promo></list-promo>
        <h3 class="product-list-caption">Produk Lainnya</h3>
        <list-product></list-product>
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  import { mapActions } from 'vuex'

  const Navbar = () => import('global/components/Navbars/VendorNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const ListPromo = () => import('global/components/Home/SlidePromo.vue')
  const ListProduct = () => import('global/components/Home/ListProduct.vue')

  export default {
    created () {
      this.initActiveUser(window._sharedData.user)
      this.getProducts()
      this.getPromo()
    },
    components: {
      Navbar,
      FooterApps,
      ListPromo,
      ListProduct
    },
    methods: {
      ...mapActions([
          'initActiveUser',
          'initProducts',
          'initPromo'
      ]),
      getProducts() {
        this.$http.get('api/product').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => {
          this.initProducts([])
        })
      },
      getPromo() {
        this.$http.get('api/promo').then(response => {
          const promo = response.data.promo
          this.initPromo(promo)
        })
      }
    }
  }
</script>
