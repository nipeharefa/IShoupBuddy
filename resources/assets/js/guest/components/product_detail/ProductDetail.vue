<template>
  <detailProduct>
    <navbar slot="navbar"></navbar>
    <footer-apps slot="footer"></footer-apps>

    <div slot="slot-touch" class="columns is-hidden-desktop product-detail-container" v-if="product">
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
    <div slot="slot-desktop" class="columns is-hidden-touch product-detail-container" v-if="product">
      <div class="column is-three-quarters left-information">
        <div class="container-information">
          <div class="column is-4">
            <div>
              <imageCover></imageCover>
            </div>
          </div>

          <div class="column">
            <div>
              <span class="product-name">{{ product.name }}</span>
              <ratings></ratings>
              <hr>
            </div>
            <div>
              <span class="product-price">{{ product.minimum_price_string }}</span>
            </div>
            <div>
              <table class="table">
                <thead>
                  <tr>
                    <td>Nama Vendor</td>
                    <td>Nama Produk</td>
                    <td>Harga</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in product.vendors">
                    <td class="vendor-name">{{ item.vendor.name }}</td>
                    <td>{{ item.vendor.name }}</td>
                    <td>{{ item.price_string }}</td>
                    <td>
                      <span class="to-cart" title="Tambahkan ke keranjang belanja">
                        <i class="fa fa-shopping-cart"></i>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <div>
          <tabs></tabs>
        </div>

      </div>

      <div class="column recommendationProducts">
        <a href="#" v-for="product in recommendation"
          :key="product.id">
          <productCard :product="product" />
        </a>
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
  const ProductCard = () => import('global/components/Others/ProductCard.vue')

  import { mapGetters } from 'vuex'

  export default {
    components: {
      DetailProduct,
      FooterApps,
      Navbar,
      DiscountBox,
      Ratings,
      Tabs,
      ImageCover,
      ProductCard
    },
    computed: {
      ...mapGetters([
        'product',
        'recommendation'
      ])
    }
  }
</script>
