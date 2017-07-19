<template>
  <div>
    <reviewRatingSummary :rating="rating" :ratingGroup="ratingArray" :totalRating="totalRating" />
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
      rating () {
        return 4.5.toFixed(1,1)
      },
      productId () {
        return this.product.id
      },
      totalRating () {
        return this.product.total_rating
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
