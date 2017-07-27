<template>
    <div class="modal is-active">
        <div class="modal-background" @click="hideAction(null)"></div>
        <div class="modal-content">
          <div v-if="complete">
            <p>Review Berhasil di Simpan</p>
          </div>
          <div v-if="!complete">
            <div class="fields">
              <label for="">Ratings</label>
              <star-rating v-model="ratings" :star-size="20":showRating="false" />
            </div>
            <div class="fields">
              <label for="">Ulasan</label>
              <textarea class="textarea" v-model="ulasan"></textarea>
            </div>
            <div class="fields buttonSave">
              <button class="button is-primary"
              @click="saveReview" :disabled="!isValid">Simpan</button>
            </div>
          </div>
        </div>
        <button class="modal-close" @click="hideAction(null)"></button>
    </div>
</template>


<style lang="scss" scoped>
  .modal-background {
    background: rgba(206, 206, 206, 0.6) !important;
  },
  .modal-content {
    padding: 2rem !important;
    background: white !important;
  },
  .modal-close {
    background-color: rgba(0, 0, 0, 0.2) !important;
  }
  .buttonSave {
    margin-top: 1rem;
  }
</style>

<script>
  import StarRating from 'vue-star-rating'

  export default {
    props: {
      transaction: {
        required: true
      },
      show: {
        required: true,
        type: Boolean
      }
    },
    methods: {
      hideAction() {

      }
    },
    computed: {
      isValid() {
        const r = this.ratings
        const u = this.ulasan

        return (r > 0 && u.length > 0)
      }
    },
    data () {
      return {
        ratings: 0,
        ulasan: '',
        complete: false
      }
    },
    components: {
      StarRating
    },
    methods: {
      hideAction () {
        this.$emit('update:show', false)
      },
      saveReview ($event) {
        const btn = $event.target

        const data = {
          rating: this.ratings,
          body: this.ulasan,
          product_id: this.transaction.product.id,
          vendor_id: this.transaction.product_vendor.vendor.id
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
