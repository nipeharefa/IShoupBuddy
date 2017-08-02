<template>
  <div class="modal is-active">
    <div class="modal-background" @click="hide"></div>
    <div class="modal-content">
      <div v-if="complete">
        <p>Review Berhasil di Simpan</p>
      </div>
      <div v-if="!check" class="fields">
        <span class="icon">
          <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
          <span class="sr-only">Loading...</span>
        </span>
        <span>Mempersiapkan formulir..</span>
      </div>
      <div v-if="!complete && check">
        <div class="fields">
          <label for="">Ratings</label>
          <star-rating v-model="review.ratings" :star-size="20":showRating="false" />
        </div>
        <div class="fields">
          <label for="">Ulasan</label>
          <textarea class="textarea" v-model="review.body"></textarea>
        </div>
        <div class="fields buttonSave">
          <button class="button is-primary"
          @click="saveReview" :disabled="!isValid">Simpan</button>
        </div>
      </div>
    </div>
    <button class="modal-close" @click="hide"></button>
  </div>
</template>

<style lang="scss" scoped>
  .buttonSave {
    margin-top: 1rem;
  }
  .modal-background {
    background: rgba(10, 10, 10, 0.86) !important;
  }
  .modal-close {
    background-color: rgba(0, 0, 0, 0.2) !important;
  }
  .modal-content {
    background: white;
    padding: 2rem;
  }
</style>


<script>

  const StarRating = () => import('vue-star-rating')

  import { mapGetters } from 'vuex'
  import querystring from 'querystring'

  export default {
    props: {
      activeProductVendor: {
        require: true
      },
      modalReviewShow: {
        require: true
      }
    },
    mounted () {
      console.log('mounted')
      this.checkReview()
    },
    beforeDestroy () {
      console.log('sebelum itu')
      this.check = false
    },
    data () {
      return {
        complete: false,
        check: false,
        review: {
          ratings: 0,
          body: ''
        }
      }
    },
    computed: {
      ...mapGetters(['activeUser']),
      isValid() {
        const r = this.review.ratings
        const u = this.review.body

        return (r > 0 && u.length > 0)
      }
    },
    components: {
      StarRating
    },
    methods: {
      checkReview () {
        const data = {
          user_id: this.activeUser.id,
          vendor_id: this.activeProductVendor.product_vendor.vendor.id,
          product_id: this.activeProductVendor.product.id
        }
        const a = querystring.stringify(data)
        this.$http.get(`api/reviewcheck/check?${a}`)
          .then(response => {
            console.log(response.data)
            this.review.ratings = response.data.review.rating
            this.review.body = response.data.review.body
            this.check = true
          }).catch(err => {
            this.check = true
          })
      },
      hide () {
        this.$emit('update:modalReviewShow', false)
      },
      saveReview ($event) {
        const btn = $event.target
        const data = {
          rating: this.review.ratings,
          body: this.review.body,
          product_id: this.activeProductVendor.product.id,
          vendor_id: this.activeProductVendor.product_vendor.vendor.id
        }

        btn.classList.add('is-loading')

        this.$http.post('api/review', data).then(response => {
          console.log(response.data)
          btn.classList.remove('is-loading')
          this.complete = true
        }).catch(err => {
          btn.classList.remove('is-loading')
        })
      }
    }
  }
</script>
