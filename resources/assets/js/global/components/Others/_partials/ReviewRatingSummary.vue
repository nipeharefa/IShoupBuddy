<template>
  <section class="review__rating">
    <div class="rating_summary">
      <div class="rating_summary__title">
        <h1 class="title is-3">{{ avgerageRating }}</h1>
      </div>
      <div class="rating_summary__small">
        <span>{{ totalRating }} Reviews</span>
      </div>
    </div>
    <div class="rating_detail">
      <ul>
        <li v-for="item in 5" v-if="ratingGroup">
          <span>{{ item }}</span>
          <progress class="progress is-success"
          :value="ratingGroup[item]" :max="totalRating"></progress>
          <span>( {{ ratingGroup[item] }} Review )</span>
        </li>
      </ul>
    </div>
  </section>
</template>


<script>
  export default {
    props: {
      ratingGroup: {
        required: true
      },
      totalRating: {
        required: true
      },
      avgerageRating: {
        required: true
      }
    }
  }
</script>
