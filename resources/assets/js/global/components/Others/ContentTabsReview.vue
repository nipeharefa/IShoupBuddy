<template>
  <div>
    <reviewRatingSummary :rating="rating" />
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
    },
    computed: {
      ...mapGetters([
        'product'
      ]),
      rating () {
        return 4.5.toFixed(1,1)
      }
    },
    components: {
      ReviewRatingSummary,
      ReviewList
    },
    data () {
      return {
        reviews: null
      }
    },
    methods: {
      getReview () {
        const productId = this.product.id
        this.$http.get(`api/review?product_id=${productId}`).then(response => {
          this.reviews = response.data.reviews
        }).catch(err => err)
      },
      getSmallImage(value){
        return "/image/medium/" + value;
      }
    }
  }
</script>
