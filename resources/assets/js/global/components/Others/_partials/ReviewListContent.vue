<template>
  <div class="media-content">
    <div class="content">
      <p>
        <strong>
          {{ review.user.name }}
        </strong> <small></small>
        <small>{{ timeFromNow(review.date) }}</small>
        <br>
        <div class="rating-info">
          <star-rating :rating="review.rating" :star-size="12"
          :read-only="true" :showRating="false"></star-rating>
          <span class="tag is-small" title="Hasil Sentimen">
            {{ ratingString }}
          </span>
        </div>
        <span class="review-body">{{ review.body }}</span>
      </p>
    </div>
    <nav class="level is-mobile">
      <div class="level-left">
        <a class="level-item" v-if="activeUser">
          <span class="icon is-small" @click="report(review)" v-if="!reported">
            <i class="fa" :class="{'fa fa-flag': !onProcess,
            'fa-circle-o-notch fa-spin fa-3x fa-fw': onProcess}"></i>
          </span>
          <span v-if="reported" class="tag is-info">Laporan sudah dikirim</span>
        </a>
      </div>
    </nav>
  </div>
</template>

<style lang="scss" scoped>
  .rating-info {
    display: flex;
  }
</style>

<script>
  import moment from 'moment'
  moment.locale('id')
  import StarRating from 'vue-star-rating'
  import { mapGetters } from 'vuex'

  export default {
    props: {
      review: {
        required: true
      }
    },
    components: {
      StarRating
    },
    data () {
      return {
        onProcess: false,
        reported: false
      }
    },
    computed: {
      ...mapGetters(['activeUser']),
      ratingString () {
        if (this.review) {
          switch(this.review.summary_text) {
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
        return "Netral";
      },
    },
    methods: {
      timeFromNow (time) {
        return moment(time).fromNow()
      },
      report (review) {
        const data = {
          review_id: review.id
        }
        this.onProcess = true
        this.$http.post('api/report', data).then(response => {
          console.log(response.data)
          this.onProcess = false
          this.reported = true
        }).catch(err => {
          this.onProcess = false
        })
      }
    }
  }
</script>
