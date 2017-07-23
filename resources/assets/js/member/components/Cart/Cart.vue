<template>
  <div id="sub-apps">

    <div>
      <navbar />
    </div>

    <section class="section">
      <div class="container">
        <breadCrumb />

        <div class="columns">
          <div class="column is-two-thirds">
            <panelCart v-for="(item, $index) in carts"
            :Key="item.id" :cart="item" :cartIndex="$index">

            </panelCart>
          </div>
          <totalBelanja :cartsTotalString="cartsTotalString" />
        </div>

      </div>
    </section>

    <div>
      <footer-apps></footer-apps>
    </div>

  </div>
</template>


<style lang="scss" scoped>
  article.media {
    width: 100%;
    .media-content {
      .content {
        display: flex;
        div.product-name {
          display: flex;
          flex:1 ;
          p.product-name {
            flex: 0.5;
          }
        }
        .subtotal {
          display: flex;
          align-items: center;
          i {
            font-size: 1rem;
            cursor: pointer;
          }
          span {
            font-size: 0.85rem;
            margin-right: 0.3rem;
            font-weight: 400;
          }
        }
      }
      .quantity-control {
        .in-quan {
          width: 50px !important;
        }
      }
    }
  }
  .total-cart {
    display: flex;
    flex-direction: column;
    text-align: center;
    span.cart-total {
      font-weight: bolder;
    }
    span.cart-lbl {
      font-size: 0.85rem;
    }
  }
</style>

<script>
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')
  const TotalBelanja = () => import('./TotalBelanja.vue')
  const PanelCart = () => import('./PanelCart.vue')

  import accounting from 'accounting-js'

  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      Navbar,
      FooterApps,
      BreadCrumb,
      TotalBelanja,
      PanelCart
    },
    computed: {
      ...mapGetters(['carts', 'cartsTotal', 'cartsTotalString'])
    },
    methods: {
      addQuantity (product) {
        product.quantity++
      },
      subQuantity (product) {
        product.quantity--
      },
      deleteItem (cartid, detailid) {
        this.$http.delete(`api/cart/${cartid}/detail/${detailid}`)
          .then(response => {
            console.log(response)
          }).catch(err => err)
      },
      formattingPrice (price) {
        return accounting.formatMoney(price, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      }
    }
  }
</script>
