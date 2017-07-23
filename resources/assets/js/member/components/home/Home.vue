<template>
  <div id="sub-apps-member">
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
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const ListPromo = () => import('global/components/Home/SlidePromo.vue')
  const ListProduct = () => import('global/components/Home/ListProduct.vue')

  import { mapActions, mapGetters } from 'vuex'

  export default {
    created () {
      this.getProducts()
      this.getPromo()
      this.initActiveUser(window._sharedData.user)
    },
    components: {
      Navbar,
      FooterApps,
      ListPromo,
      ListProduct
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
        this.$http.get('api/product?perpage=50').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => {
          this.initProducts([])
        })
      },
      getPromo() {
        this.$http.get('api/product/newest?perpage=10&page=1').then(response => {
          const promo = response.data.products
          this.initPromo(promo)
        })
      }
    }
  }
</script>
