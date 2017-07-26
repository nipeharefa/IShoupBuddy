<template>
  <div>
    <section id="navbar">
      <navbar />
    </section>


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

    <div id="footer-apps">
      <footer-apps></footer-apps>
    </div>

  </div>
</template>


<script>

  import { mapGetters, mapActions } from 'vuex'
  const FooterApps = () => import('otherComponents/Footer.vue')
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const SlideCompare = () => import('global/components/Product/SlideCompare.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')

  export default {
    components: {
      Navbar,
      FooterApps,
      SlideCompare,
      BreadCrumb
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
