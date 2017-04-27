<template>
  <div class="wrapping">
    <div class="nusa" v-for="item in products">
      <a href="/product/1" class="alinkto">
        <product-card :product="item"></product-card>
      </a>
    </div>
  </div>
</template>


<script>
  import ProductCard from 'otherComponents/ProductCard.vue'
  export default {
    props: [
      'products'
    ],
    components: {
      ProductCard
    }
  }
</script>
