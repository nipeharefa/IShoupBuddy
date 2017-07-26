<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>

    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <breadCrumb />
          </div>
        </div>

        <slideCompare :activeProduct="activeProduct" :promo="promo" />

      </div>
    </section>

    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const BreadCrumb = () => import('./Breadcrumb.vue')
  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  const SlideProduct = () => import('global/components/Others/SlideProduct.vue')
  const SlideCompare = () => import('global/components/Product/SlideCompare.vue')

  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      FooterApps,
      BreadCrumb,
      NavbarApps,
      ProductCard,
      SlideProduct,
      SlideCompare
    },
    created () {
      this.activeProduct = window._sharedData.product
      this.getCompareProduct()
    },
    data () {
      return {
        activeProduct: null
      }
    },
    computed: {
      ...mapGetters(['promo'])
    },
    methods: {
      ...mapActions(['initPromo']),
      getCompareProduct () {
        this.$http.get(`knn?id=${this.activeProduct.id}&target=10`).then(response => {
          this.initPromo(response.data)
        })
      }
    }
  }
</script>
