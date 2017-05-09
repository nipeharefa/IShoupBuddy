<template>
  <div>
    <div>
      <navbarApps></navbarApps>
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-one-quarter is-hidden-touch">
            <sidebar></sidebar>
          </div>
          <div class="column">

            <div class="tabs">
              <ul class="tabs-register">
                <li @click="changeTabs(0)" :class="{'is-active': activeTabs === 0}">
                  <a >My Produk</a>
                </li>
                <li @click="changeTabs(1)" :class="{'is-active': activeTabs === 1}">
                  <a >Semua Produk</a>
                </li>
              </ul>
            </div>

            <div>
              <div class="tabs-content">
                <tableProduct v-if="activeTabs === 0"
                  :products="myProduct"
                  :isVendor="true"
                  :addedProduct="addedProduct"></tableProduct>
                <tableProduct v-if="activeTabs === 1" :products="products"
                  :addMyProductAction="true"
                  :addedProduct="addedProduct"></tableProduct>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div>
      <footerApps></footerApps>
    </div>
  </div>
</template>


<script>
  import { mapGetters, mapActions } from 'vuex'

  import _findIndex from 'lodash/findIndex'

  const TableProduct = () => import('global/components/Product/TableProduct.vue')
  const Sidebar = () => import('global/components/Sidebars/VendorSidebar.vue')
  const FooterApps = () => import('global/components/Footers/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/VendorNavbar.vue')

  export default {
    mounted () {
      this.getProducts()
      this.getMyProduct()
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    },
    data () {
      return {
        activeTabs: 0,
        myProduct: []
      }
    },
    components: {
      TableProduct,
      Sidebar,
      FooterApps,
      NavbarApps
    },
    methods: {
      ...mapActions([
        'initProducts'
      ]),
      getMyProduct () {
        this.$http.get('api/product?vendor_id=44').then(response => {
          this.myProduct = response.data.products
        }).catch(err => err)
      },
      getProducts () {
        this.$http.get('api/product?without_filter=true').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => err)
      },
      changeTabs (i) {
        this.activeTabs = i
        return;
      },
      addedProduct (item) {
        const index = _findIndex(this.myProduct, {id: item.id})
        if (index >= 0) {
          this.myProduct[index] = item
          return;
        }
        this.myProduct.push(item)
        return;
      }
    }
  }
</script>
