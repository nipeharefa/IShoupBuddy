<template>
  <div>
    <div class="wrapping">
      <div class="nusa" v-for="item in wishlists">
        <a :href="`/product/${item.product.id}`">
          <product-card :product="item.product"></product-card>
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
      ...mapGetters(['wishlists'])
    },
    methods: {

    }
  }
</script>
