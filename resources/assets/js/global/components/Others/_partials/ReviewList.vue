<template>
  <section class="review__list">
    <article v-if="!reviews">
      <p class="no-review has-text-centered">Belum ada Review</p>
    </article>
    <article class="media" v-for="review in reviews" v-if="reviews">
      <reviewListMedia :picture_url="review.user.picture_url" />
      <reviewListContent :review="review" />
    </article>
  </section>
</template>

<script>

  const ReviewListMedia = () =>  import('./ReviewListMedia.vue')
  const ReviewListContent = () =>  import('./ReviewListContent.vue')

  export default {
    props: {
      reviews: {
        required: true
      }
    },
    components: {
      ReviewListMedia,
      ReviewListContent
    }
  }
</script>
