<template>
  <div>
    <article v-if="!review">
      <p class="no-review has-text-centered">Belum ada Review</p>
    </article>
  	<article class="media" v-for="review in product.review" v-if="review">
    <figure class="media-left">
      <p class="image is-64x64">
        <img src="https://source.unsplash.com/category/nature/64x64">
      </p>
    </figure>
    <div class="media-content">
      <div class="content">
        <p>
          <strong>
            {{ review.user.name }}
          </strong> <small></small>
          <small>{{ timeFromNow(review.date) }}</small>
          <br>
          <span class="review-body">{{ review.body }}</span>
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <a class="level-item">
            <span class="icon is-small"><i class="fa fa-flag"></i></span>
          </a>
        </div>
      </nav>
    </div>
  </article>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  import moment from 'moment'
  moment.locale('id')

  export default {

    computed: {
      ...mapGetters([
        'product'
      ]),
      review () {
        if (this.product.review == null || this.product.review.length === 0) {
          return null
        }
        return this.product.review
      }
    },
    methods: {
      timeFromNow (time) {
        return moment(time).fromNow()
      }
    }
  }
</script>
