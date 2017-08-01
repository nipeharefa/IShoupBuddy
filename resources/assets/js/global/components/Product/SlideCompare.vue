<template>
  <div class="columns">
    <div class="column is-2">
      <a :href="`/product/${activeProduct.id}`">
        <productCard :product="activeProduct" />
      </a>
    </div>
    <div class="column is-10 is-slide-compare">
       <slideProduct :products="promo" />
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</template>

<style lang="scss">
  .is-slide-compare {
    padding-left: 60px;

  }
  .swiper-slide {
    padding: 0.1rem 0.2rem;
  }
  .swiper-button-prev {
    left: 12rem !important;
  }
  .swiper-button-next {
    right: -3rem !important;
  }
</style>

<script>
  const SlideProduct = () => import('global/components/Others/SlideProductCompare.vue')
  const ProductCard = () => import('global/components/Others/ProductCardCompare.vue')
  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      SlideProduct,
      ProductCard
    },
    props: {
      activeProduct: {
        required: true
      },
      promo: {
        required: true
      }
    }
  }
</script>
