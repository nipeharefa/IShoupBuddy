<template>
  <div class="card product-card">
    <div class="product-media">
      <figure>
        <img :src="product.picture_url.small" :alt="product.name">
      </figure>
    </div>
    <div class="product-description">
      <div class="product-name">
        <h3>{{ product.name }}</h3>
      </div>
      <div class="harga">
        <span>Rp. {{ product.minimum_price }}</span>
      </div>
      <div>
          <star-rating :rating="product.avg_rating"
            :star-size="15" :read-only="true"
            :showRating="false"
            :activeColor="'#f7d120'" />
      </div>
    </div>
  </div>
</template>

<script>
  import StarRating from 'vue-star-rating'
  export default {
    props: ['product'],
    components: {
      StarRating
    }
  }
</script>
