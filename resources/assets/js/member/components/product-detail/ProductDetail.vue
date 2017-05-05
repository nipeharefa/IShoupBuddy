<template>
  <detail-product>
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
        </div>
        <button-control-touch></button-control-touch>
        <tabs></tabs>
      </div>
    </div>
    </section>
  </detail-product>
</template>

<script>
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const Ratings = () => import('global/components/Others/Ratings.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const DetailProduct = () => import('global/components/Product/DetailProduct.vue')
  const DiscountBox = () => import('global/components/Others/DiscountBox.vue')
  const ButtonControlTouch = () => import('global/components/Others/ButtonControlTouch')
  const Tabs = () => import('global/components/Others/Tabs.vue')
  const ImageCover = () => import('global/components/Others/ImageInProductDetail.vue')

  import { mapGetters } from 'vuex'

  export default {
    components: {
      FooterApps,
      Navbar,
      DetailProduct,
      Ratings,
      DiscountBox,
      ButtonControlTouch,
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
