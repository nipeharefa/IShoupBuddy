<template>
  <div class="columns">
    <div class="column wrapping">
      <div class="nusa" v-for="item in products" v-if="products">
        <a :href="`/product/${item.id}`" class="alinkto">
          <product-card :product="item"></product-card>
        </a>
      </div>
      <div class="nusa" v-if="!products" v-for="item in 5">
        <a href="#" class="alinkto">
          <productCardPlaceholder />
        </a>
      </div>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  import ProductCardPlaceholder from 'global/components/Others/ProductCardPlaceholder.vue'
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
