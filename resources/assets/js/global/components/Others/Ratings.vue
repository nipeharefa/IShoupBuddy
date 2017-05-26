<template>
	<div class="rating">
		<star-rating :rating="4" :star-size="20" :read-only="true" :showRating="false"></star-rating>
		<p>({{ ratings }} Ulasan)</p>
	</div>
</template>


<script>
import StarRating from 'vue-star-rating'
export default {
  props: {
    ratings: {
      default: 0
    }
  },
  components: {
    StarRating
  }
}
</script>
