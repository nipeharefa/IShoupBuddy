<template>
  <div id="sub-apps">
    <div>
      <navbar></navbar>
    </div>
    <section class="section">
      <div class="container">
        <list-promo></list-promo>
        <list-product></list-product>
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  const Navbar = () => import('global/components/Navbars/AdminNavbar.vue')
  const ListPromo = () => import('global/components/Home/SlidePromo.vue')
  const ListProduct = () => import('global/components/Home/ListProduct.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')

  import { mapActions, mapGetters } from 'vuex'

  export default {
    created () {
      this.getProducts()
      this.getPromo()
      this.initActiveUser(window._sharedData.user)
    },
    components: {
      ListPromo,
      ListProduct,
      FooterApps,
      Navbar
    },
    computed: {
      ...mapGetters([
        'products',
        'promo'
      ])
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
