<template>
  <div class="columns">
    <div class="column wrapping">
      <div class="nusa" v-for="item in products">
        <a :href="`/product/${item.id}`" class="alinkto">
          <product-card :product="item"></product-card>
        </a>
      </div>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  export default {
    components: {
      ProductCard
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    }
  }
</script>
