<template>
  <div>
    <div>
      <navbar></navbar>
    </div>
    <section class="section">
      <div class="container">

        <div class="columns">
          <div class="column">
            <div class="caption-head">
              <h1 class="is-4">Promo Terbaru</h1>
            </div>
          </div>
        </div>
        <div class="columns">
          <div class="column wrapping">
            <div class="swiper-container">
               <div class="swiper-wrapper">

                    <div class="swiper-slide nusa" v-for="item in 6">
                  <product-card></product-card>
                </div>

                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
          </div>
        </div>

      </div>

      <div class="container">
        <div class="columns">
          <div class="column">
            <div class="caption-head">
              <h1 class="is-4">Produk Lainnya </h1>
            </div>
          </div>
        </div>


        <div class="columns">
          <div class="column wrapping">
            <div class="nusa" v-for="item in products">
              <a href="/product/1" class="alinkto">
                <product-card :product="item"></product-card>
              </a>
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


<script>
  const Navbar = () => import('otherComponents/Navbars/NavbarMemberGlobal.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const ProductCard = () =>  import('otherComponents/ProductCard.vue')

  import { mapActions, mapGetters } from 'vuex'

  export default {
    name: 'Home_Member',
    mounted() {

      var mySwiper = new Swiper ('.swiper-container', {
        nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          slidesPerView: 4,
          spaceBetween: 10,
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 10
            },
            480: {
              slidesPerView: 1,
              spaceBetween: 10
            },
            640: {
              slidesPerView: 3,
              spaceBetween: 10
            }
          }
      })
      this.initActiveUser(window._sharedData.user)
      this.getProducts()
    },
    components: {
      Navbar,
      ProductCard,
      FooterApps
    },
    methods: {
      ...mapActions([
        'initActiveUser',
        'initProducts'
      ]),
      getProducts() {
        this.$http.get('api/product').then(response => {
          this.initProducts(response.data.products)
        }).catch(err => {
          this.initProducts([])
        })
      }
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    }
  }
</script>
