<template>
	<div class="discount-box">
    	<div class="harga">
    		<p class="after-discount title is-3">{{ product.minimum_price_string }}</p>

    	</div>

    	<div class="percent-discount is-hidden-desktop">
    	</div>
	</div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'product'
      ])
    }
  }
</script>
