<template>
	<div class="card">
	  <div class="card-image">
	    <figure class="image is-4by3">
	      <img :src="product.picture_url.small" :alt="product.name">
	    </figure>
	  </div>
	  <div class="card-content">

	    <div class="content">
	      <small>{{ product.name }}</small>
	    </div>
      <div class="harga">
        Rp. 10.000
      </div>
      <div>
          <star-rating :increment="0.01" :rating="4"
           :star-size="15"
           :read-only="true"
           :showRating="false" :activeColor="'#f7d120'"></star-rating>
      </div>
	  </div>
	</div>
</template>

<script>
  const StarRating = () => import('vue-star-rating')
  // import StarRating from 'vue-star-rating'
  export default {
    props: ['product'],
    components: {
      StarRating
    }
  }
</script>


<style lang="scss" scoped>
  .card-content {
    small {
      line-height: 1.8;
      height: 3.6rem;
      display: inline-block;
    }
  }
</style>
