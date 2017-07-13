<template>
  <div id="sub-apps">
    <div>
      <navbar />
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <nav class="breadcrumb">
              <ul>
                <li><a href="/">Halaman Depan</a></li>
                <li class="is-active"><a>Keranjang Belanja</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="columns">
          <div class="column is-two-thirds">
            <nav class="panel" v-if="carts" v-for="item in carts">
              <p class="panel-heading">{{ item.vendor.name }}</p>
               <div class="panel-block" v-for="product in item.item">
                 <article class="media">
                    <figure class="media-left">
                      <p class="image is-64x64">
                        <img :src="product.product.picture_url.small">
                      </p>
                    </figure>
                    <div class="media-content">
                      <div class="content">
                        <div class="product-name">
                          <p class="product-name">{{ product.product.name }}</p>
                        </div>
                        <div class="subtotal">
                          <span>{{ product.price }}</span>
                          <i class="fa fa-trash" @click="deleteItem(item.id, product.id)"></i>
                        </div>
                      </div>
                      <div class="quantity-control">
                        <div class="field has-addons">
                          <p class="control">
                            <button class="button is-small">-</button>
                          </p>
                          <p class="control">
                            <input class="input is-small in-quan"
                            type="text" placeholder="1" v-model="product.quantity">
                          </p>
                          <p class="control">
                            <button class="button is-small">+</button>
                          </p>
                        </div>
                      </div>
                    </div>
                  </article>
               </div>
            </nav>
          </div>
          <div class="column">
            <div class="total-cart">
              <span class="title is-4 cart-total">{{ cartsTotalString }}</span>
              <span class="cart-lbl">Total Belanja</span>
            </div>
          </div>
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

  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      Navbar,
      FooterApps
    },
    computed: {
      ...mapGetters(['carts', 'cartsTotal', 'cartsTotalString'])
    },
    methods: {
      deleteItem (cartid, detailid) {
        this.$http.delete(`api/cart/${cartid}/detail/${detailid}`)
          .then(response => {
            console.log(response)
          }).catch(err => err)
      }
    }
  }
</script>
