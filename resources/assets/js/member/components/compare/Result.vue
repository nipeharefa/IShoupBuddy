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

        <div class="columns">
          <cardResult class="column is-half" :product="source" />
          <cardResult class="column is-half" :product="target" />
        </div>

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
  const BreadCrumb = () => import('./Breadcrumb-Compare.vue')
  const CardResult = () => import('./CardResult.vue')

  export default {
    components: {
      Navbar,
      FooterApps,
      SlideCompare,
      BreadCrumb,
      BreadCrumb,
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
