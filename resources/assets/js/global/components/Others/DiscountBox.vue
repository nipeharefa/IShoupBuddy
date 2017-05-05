<template>
	<div class="discount-box">
    	<div class="harga">
    		<p class="after-discount title is-3">{{ product.minumumPrice }}</p>
    		<p class="normal-price">100.000</p>

    	</div>

    	<div class="percent-discount is-hidden-desktop">
    		<p class="title is-4">38 %</p>
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
