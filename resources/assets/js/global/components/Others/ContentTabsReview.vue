<template>
  <div>
    <reviewRatingSummary :ratingGroup="ratingArray"
      :totalRating="totalRating" :avgerageRating="avgerageRating" />
    <reviewList :reviews="reviews" />
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  const ReviewRatingSummary = () => import('./_partials/ReviewRatingSummary.vue')
  const ReviewList = () => import('./_partials/ReviewList.vue')

  export default {
    created () {
      this.getReview()
      this.getGroupRating()
    },
    computed: {
      ...mapGetters([
        'product'
      ]),
      productId () {
        return this.product.id
      },
      totalRating () {
        return this.product.total_rating
      },
      avgerageRating () {
        if (this.product.avg_rating) {
          return this.product.avg_rating.toFixed(1,1)
        }
        return 0
      }
    },
    components: {
      ReviewRatingSummary,
      ReviewList
    },
    data () {
      return {
        reviews: null,
        ratingArray: null
      }
    },
    methods: {
      getReview () {
        this.$http.get(`api/review?product_id=${this.productId}`).then(response => {
          this.reviews = response.data.reviews
        }).catch(err => err)
      },
      getSmallImage(value){
        return "/image/medium/" + value;
      },
      getGroupRating() {
        this.$http.get(`api/product/${this.productId}/group-rating`).then(response => {
          console.log(response.data)
          this.ratingArray = response.data
        }).catch(err => err)
      }
    }
  }
</script>
