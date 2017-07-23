<template>
  <div class="card product-card">
    <div class="product-media">
      <figure>
        <img :alt="product.name" v-lazy="renderImg(product.picture_url.medium)">
      </figure>
    </div>
    <div class="product-description">
      <div class="product-name">
        <h3>{{ product.name }}</h3>
      </div>
      <div class="harga">
        <span>{{ product.minimum_price_string }}</span>
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
    props: {
      product: {
        type: Object,
        required: true
      }
    },
    components: {
      StarRating
    },
    methods: {
      renderImg (photo) {
        if (!photo) {
          return '/images/assets/profile-no-pic.jpg'
        }

        const img = {
          src: photo,
          error: '/img/product-image-not-available.gif',
          loading: '/img/ring-loader.svg'
        }
        return img
      }
    }
  }
</script>
