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
            <b>
              <p>{{ product.name }}</p>
            </b>
          </div>
          <ratings :ratings="product.total_rating"></ratings>
          <discount-box></discount-box>
        </div>
        <button-control-touch></button-control-touch>
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
              <ratings
              :total="product.total_rating"
              :calculate="calculateSummary"
              :ratings="product.avg_rating"></ratings>
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
  const Navbar = () => import('global/components/Navbars/AdminNavbar.vue')
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
      ]),
      calculateSummary () {
        var res = {
          class: 'is-info',
          text: 'Keseluruhan: Netral'
        }
        if (this.product.summary) {
          var maxMean = Math.max(this.product.summary.mean.pos,
            this.product.summary.mean.neg,
            this.product.summary.mean.neu)

          if (maxMean == 0) {
            return res
          }

          var isPos = maxMean == this.product.summary.mean.pos
          var isNeu = maxMean == this.product.summary.mean.neu
          var isNeg = maxMean == this.product.summary.mean.neg

          var totalReview = this.product.total_review

          var posPercent = this.product.summary.count.pos / totalReview
          var neuPercent = this.product.summary.count.neu / totalReview
          var negPercent = this.product.summary.count.neg / totalReview


          if (isPos && isNeg && isNeu) {
            return res;
          } else if (isPos && posPercent >= 0.8) {
            res = {
              class: 'is-primary',
              text: 'Keseluruhan: Luar biasa positif'
            }
          } else if (isPos && posPercent >= 0.65) {
            res = {
              class: 'is-primary',
              text: 'Keseluruhan: Sangat positif'
            }
          } else if (isPos || isNeu && posPercent >= 0.5) {
            res = {
              class: 'is-primary',
              text: 'Keseluruhan: positif'
            }
          } else if (isNeg && isNeu && negPercent >= 0.8) {
            res = {
              class: 'is-danger',
              text: 'Keseluruhan: negatif'
            }
          } else if (isNeg && negPercent >= 0.65) {
            res = {
              class: 'is-danger',
              text: 'Keseluruhan: Sangat Negatif'
            }
          } else if (isNeg || negPercent >= 0.5) {
            res = {
              class: 'is-danger',
              text: 'Keseluruhan: Luar biasa negatif'
            }
          } else {
              return res
          }
          return res
        }
      }
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
