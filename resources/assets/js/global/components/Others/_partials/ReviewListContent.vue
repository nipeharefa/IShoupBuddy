<template>
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
</template>


<script>
  import moment from 'moment'
  moment.locale('id')
  export default {
    props: {
      review: {
        required: true
      }
    },
    methods: {
      timeFromNow (time) {
        return moment(time).fromNow()
      }
    }
  }
</script>
