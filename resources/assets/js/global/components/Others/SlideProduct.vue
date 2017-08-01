<template>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="nusa swiper-slide" v-for="item in products">
        <a :href="`/product/${item.id}`" class="alinkto">
          <product-card :product="item"></product-card>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  export default {
    props: {
      products: {
        type: Array,
        default: []
      }
    },
    components: {
      ProductCard
    },
    mounted() {
      this.setupSwiper()
    },
    updated() {
      if (this.swiper) {
        this.swiper.update()
      }
    },
    data () {
      return {
        swiper: false
      }
    },
    methods: {
      setupSwiper () {
        this.swiper = new Swiper ('.swiper-container', {
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          slidesPerView: 5,
          breakpoints: {
            320: {
              slidesPerView: 1
            }
          }
        })
      }
    }
  }
</script>
