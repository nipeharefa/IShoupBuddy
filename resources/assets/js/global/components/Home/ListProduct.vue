<template>
  <div class="columns">
    <div class="column wrapping">
      <div class="nusa" v-for="item in products">
        <a :href="`/product/${item.id}`" class="alinkto">
          <!-- <product-card :product="item"></product-card> -->
          <productCardPlaceholder />
        </a>
      </div>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  const ProductCardPlaceholder = () => import('global/components/Others/ProductCardPlaceholder.vue')
  export default {
    components: {
      ProductCard,
      ProductCardPlaceholder
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    }
  }
</script>
