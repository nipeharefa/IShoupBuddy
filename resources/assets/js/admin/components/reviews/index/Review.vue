<template>
  <div class="review-details__wrapper column is-half">
    <div class="review-user-image__wrapper">
      <img :src="review.user.picture_urls.small" alt="" class="user__image">
    </div>
    <div class="review-user-body__wrapper">
      <div class="review-user__head">
        <div class="user-review__info">
          {{ review.user.name }}
          <span class="reviewedFromNow">{{ reviewedFromNow }}</span>
        </div>
        <div class="action__block">
          <span class="icon" @click="deleteReview" v-if="!review.trashed">
            <i class="fa"
            :class="{'fa-trash': !onDelete, 'fa-circle-o-notch fa-spin fa-3x fa-fw': onDelete}"></i>
          </span>

          <span class="icon" @click="restoreReview" v-if="review.trashed">
            <i class="fa"
            :class="{'fa-eye': !onDelete, 'fa-circle-o-notch fa-spin fa-3x fa-fw': onDelete}"></i>
          </span>

        </div>
      </div>
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
  import iziToast from 'izitoast'
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
    data () {
      return {
        onDelete: false
      }
    },
    computed: {
      reviewedFromNow () {
        moment().locale('id')
        return moment(this.review.date).fromNow()
      }
    },
    methods: {
      deleteReview() {
        const id = this.review.id
        this.onDelete = true
        this.$http.delete(`api/review/${id}`)
          .then(repsonse => {
            this.onDelete = false
            iziToast.success({
              title: 'Sukses',
              message: 'Review berhasil di hapus',
              position: 'bottomRight'
            })
            this.review.trashed = true
          }).catch(err => {
            this.onDelete = false
          })
      },
      restoreReview() {
        const id = this.review.id
        this.onDelete = true
        this.$http.post(`api/review/${id}/restore`)
          .then(repsonse => {
            this.onDelete = false
            iziToast.success({
              title: 'Sukses',
              message: 'Review berhasil dikembalikan',
              position: 'bottomRight'
            })
            this.review.trashed = false
          }).catch(err => {
            this.onDelete = false
          })
      }
    }
  }
</script>
