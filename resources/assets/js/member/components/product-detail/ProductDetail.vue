<template>
  <detail-product>
    <navbar slot="navbar"></navbar>
    <footer-apps slot="footer"></footer-apps>

    <div slot="otherComponents">
      <modalAddToCart :show.sync="showModals"
        @update:show="ganti" :product="product" :product_vendor="product_vendor" v-if="product"/>
    </div>

    <div slot="slot-touch" class="columns is-hidden-desktop" v-if="product">
      <div class="column">
        <div>
          <imageCover></imageCover>
          <div>
            <span class="product-name">{{ product.name }}</span>
          </div>
          <ratings :ratings="product.total_rating"></ratings>
          <div class="wrapper-wish">
            <wishListButton :productId="product.id" />
            <a :href="`/compare/${product.id}`" class="button is-small">Compare</a>
          </div>
        </div>
          <div>
            <table class="table table-add-tocart-mobile">
              <thead>
                <tr>
                  <td>Nama Vendor</td>
                  <td>Harga</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in product.vendors">
                  <td class="vendor-name">{{ item.vendor.name }}</td>
                  <td>{{ item.price_string }}</td>
                  <td>
                    <button class="button is-danger"
                    @click="showModalToCart(item)"
                    title="Tambahkan ke keranjang belanja" >
                      <i class="fa fa-shopping-cart"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        <tabs></tabs>
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
              <ratings :ratings="product.total_rating"></ratings>
              <wishListButton :productId="product.id" />
              <a :href="`/compare/${product.id}`" class="button is-small">Compare</a>
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
                    <td>Harga</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in product.vendors">
                    <td class="vendor-name">{{ item.vendor.name }}</td>
                    <td>{{ item.price_string }}</td>
                    <td>
                      <span class="to-cart" title="Tambahkan ke keranjang belanja" @click="showModalToCart(item)">
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
        <div class="other-product">
          <b>Produk Lainnya</b>
        </div>
        <template v-for="product in recommendation">
          <div class="item-recommendation">
            <a :href="`/product/${product.id}`">
              <productCard :product="product" />
            </a>
          </div>
        </template>
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
  const ModalAddToCart = () => import('global/components/Cart/ModalAddProductToCart.vue')
  const ModalsBaru = () => import('global/components/Cart/ModalAddProductToCart.vue')
  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  const WishListButton = () => import('global/components/Others/WishListButton.vue')

  import { mapGetters } from 'vuex'

  export default {
    components: {
      FooterApps,
      Navbar,
      ModalsBaru,
      DetailProduct,
      Ratings,
      DiscountBox,
      ButtonControlTouch,
      Tabs,
      ImageCover,
      ModalAddToCart,
      ProductCard,
      WishListButton
    },
    computed: {
      ...mapGetters([
        'product',
        'recommendation'
      ])
    },
    data ()  {
      return {
        showModals: false,
        product_vendor: {}
      }
    },
    methods: {
      showModalToCart (item) {
        this.showModals = true
        this.product_vendor = item
      },
      ganti (param1) {
        console.log(param1)
      }
    }
  }
</script>
