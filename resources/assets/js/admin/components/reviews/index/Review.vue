<template>
  <div class="review-details__wrapper column is-half">
    <div class="review-user-image__wrapper">
      <img :src="review.user.picture_urls.small" alt="" class="user__image">
    </div>
    <div class="review-user-body__wrapper">
      <p class="review-user-name">
        {{ review.user.name }}
        <span class="reviewedFromNow">{{ reviewedFromNow }}</span>
      </p>
      <star-rating :rating="review.rating"
            :star-size="15" :read-only="true"
            :showRating="false"
            :activeColor="'#f7d120'" />
      <span class="review-details__caption">mereview produk <a href="">{{ review.product.name }}</a></span>
      <p class="review-details__text">{{ review.body }}</p>
    </div>
  </div>
</template>

<script>
  import StarRating from 'vue-star-rating'
  import moment from 'moment'
  require("moment/locale/id.js")
  export default {
    props: {
      review: {
        required: true,
        type: Object
      }
    },
    components: {
      StarRating
    },
    computed: {
      reviewedFromNow () {
        moment().locale('id')
        return moment(this.review.date).fromNow()
      }
    }
  }
</script>
