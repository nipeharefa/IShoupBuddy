<template>
  <div class="main-thumbnail">
    <figure class="image is-4by3">
      <img :src="product.picture_url['small']" :alt="product.name" class="">
    </figure>
  </div>
</template>

<style lang="scss" scoped>
  .main-thumbnail {
    img {
      object-fit: scale-down;
    }
  }
</style>

<script>
  /**
   * Image thumbnail spesific to detail product
   */

  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'product'
      ])
    }
  }
</script>
