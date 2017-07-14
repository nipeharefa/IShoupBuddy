<template>

  <div>
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            Administrator
          </router-link>
        </li>
        <li class="is-active"><a>Review</a></li>
      </ul>
    </nav>
    <div class="review__wrapper columns">
      <review v-for="item in reviews" :review="item" :key="item.id" />
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  const Review = () => import('./Review.vue')
  export default {
    components: {
      Review
    },
    computed: {
      ...mapGetters([
        'reviews'
      ])
    },
  }
</script>
