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

        <div class="columns">
          <cardResult class="column is-half" :product="source" />
          <cardResult class="column is-half" :product="target" />
        </div>

      </div>
    </section>

    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<style lang="scss" scoped>
  .table {
    .caption {}
  }
</style>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const BreadCrumb = () => import('./Breadcrumb-Compare.vue')
  const CardResult = () => import('./CardResult.vue')
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
      SlideCompare,
      CardResult
    },
    created () {
      this.source = window._sharedData.source
      this.target = window._sharedData.target
    },
    data () {
      return {
        activeProduct: null,
        source: null,
        target: null
      }
    },
    computed: {
      ...mapGetters(['promo'])
    }
  }
</script>
