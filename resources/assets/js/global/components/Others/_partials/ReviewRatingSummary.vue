<template>
  <section class="review__rating">
    <div class="rating_summary">
      <div class="rating_summary__title">
        <h1 class="title is-3">4.5</h1>
      </div>
      <div class="rating_summary__small">
        <span>20 Reviews</span>
      </div>
    </div>
    <div class="rating_detail">
      <ul>
        <li v-for="item in 5">
          <span>{{ rating }}</span>
          <span>( 5 Review )</span>
        </li>
      </ul>
    </div>
  </section>
</template>


<script>
  export default {
    props: {
      rating: {
        required: true
      }
    }
  }
</script>
