<template>
  <detailProduct>
    <navbar slot="navbar"></navbar>
    <footer-apps slot="footer"></footer-apps>

    <div slot="slot-touch" class="columns is-hidden-desktop" v-if="product">
      <div class="column">
        <div>
          <imageCover></imageCover>
          <div>
            <b>
              <p>{{ product.name }}</p>
            </b>
          </div>
          <ratings></ratings>
          <discount-box></discount-box>
          <tabs></tabs>
        </div>
      </div>
    </div>
  </detailProduct>
</template>

<script>

  const DetailProduct = () => import('global/components/Product/DetailProduct.vue')
  const Navbar = () => import('global/components/Navbars/GuestNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const DiscountBox = () => import('global/components/Others/DiscountBox.vue')
  const Ratings = () => import('global/components/Others/Ratings.vue')
  const Tabs = () => import('global/components/Others/Tabs.vue')
  const ImageCover = () => import('global/components/Others/ImageInProductDetail.vue')

  import { mapGetters } from 'vuex'

  export default {
    components: {
      DetailProduct,
      FooterApps,
      Navbar,
      DiscountBox,
      Ratings,
      Tabs,
      ImageCover
    },
    computed: {
      ...mapGetters([
        'product'
      ])
    }
  }
</script>
