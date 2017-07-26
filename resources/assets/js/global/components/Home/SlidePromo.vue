<template>
  <div class="columns">
    <div class="column wrapping">
      <slide-product :products="promo"></slide-product>
      <div class="swiper-button-prev" v-if="promo"></div>
      <div class="swiper-button-next" v-if="promo"></div>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  const SlideProduct = () => import('global/components/Others/SlideProduct.vue')
  export default {
    components: {
      SlideProduct
    },
    computed: {
      ...mapGetters([
        'promo'
      ])
    }
  }
</script>
