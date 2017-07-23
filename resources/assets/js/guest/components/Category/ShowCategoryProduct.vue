<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>

    <section class="section">
      <div class="container">
        <breadcrumb />
        <h1 class="is-3 category-name">
          <span>Kategory <a :href="`/c/${category.slug}`">{{ category.name }}</a></span>
        </h1>
        <list-products></list-products>
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
  const Breadcrumb = () => import('./_partials/Breadcrumb/ShowCategoryProduct.vue')
  const ListProducts = () => import('global/components/Home/ListProduct.vue')

  import { mapGetters } from 'vuex'

  export default {
    created () {
      this.category = window._sharedData.category
    },
    components: {
      FooterApps,
      NavbarApps,
      Breadcrumb,
      ListProducts
    },
    data () {
      return {
        category: null
      }
    },
    computed: {
      ...mapGetters(['products'])
    }
  }
</script>
