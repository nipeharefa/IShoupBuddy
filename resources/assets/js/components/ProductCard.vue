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

	  </div>
	</div>
</template>

<script>
  export default {
    props: ['product']
  }
</script>


<style lang="scss" scoped>
  .card-content {
    min-height: 6rem !important;
  }
</style>
