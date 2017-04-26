<template>
	<div class="rating">
		<star-rating :rating="4" :star-size="20" :read-only="true" ></star-rating>
		<p>(10 Ulasan)</p>
	</div>
</template>


<script>
	import StarRating from 'vue-star-rating'
	export default {

		components: {
			StarRating
		}
	}
</script>
