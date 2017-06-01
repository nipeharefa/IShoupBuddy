<template>
  <div class="wrapping">
    <div class="nusa" v-for="item in products">
      <a :href="`/product/${item.id}`" class="alinkto">
        <product-card :product="item"></product-card>
      </a>
    </div>
  </div>
</template>


<script>
  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  export default {
    props: [
      'products'
    ],
    components: {
      ProductCard
    }
  }
</script>
