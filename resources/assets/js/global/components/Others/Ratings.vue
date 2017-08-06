<template>
	<div class="rating">
		<star-rating :rating="ratings"
    :star-size="20" :increment="0.01"
    :read-only="true" :showRating="false"></star-rating>
		<p class="total_reviewers">({{ total }} Ulasan)</p>
    <span class="tag is-small" :class="calculate.class" title="Hasil Sentimen">
      {{ calculate.text }}
    </span>
	</div>
</template>

<style lang="scss" scoped>
  .total_reviewers {
    padding: 0 0.5rem;
  }
</style>

<script>
import StarRating from 'vue-star-rating'
import { mapGetters } from 'vuex'

export default {
  props: {
    ratings: {
      default: 0
    },
    total: {
      default: 0
    },
    calculate: {
      type: Object,
      default: function () {
        return { class: 'is-netral', text: 'Netral' }
      }
    }
  },
  computed: {
    ...mapGetters(['product']),
    ratingString () {
      if (this.product) {
        switch(this.product.summary_string) {
          case 'pos':
            return "Positif"
            break
          case 'neg':
            return "Negatif"
            break
          default:
            return "Netral"
            break
        }
      }
      return "Unknown"
    },
    classRating () {
      if (this.product) {
        switch(this.product.summary_string) {
          case 'pos':
            return 'is-success'
            break
          case 'neg':
            return 'is-danger'
            break
          default:
            return 'is-info'
            break
        }
      }
    }
  },
  components: {
    StarRating
  }
}
</script>
