<template>
	<div>
		<p>{{ product.description }}</p>
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
