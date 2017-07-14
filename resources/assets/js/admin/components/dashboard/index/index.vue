<template>
  <div>

    <div class="columns">
      <div class="column">
        <div class="container-info">
          <span class="title is-4 has-text-centered">{{ users.length || 0 }}</span>
          <span class="type has-text-centered">Users</span>
        </div>
      </div>
      <div class="column">
        <div class="container-info">
          <span class="title is-4 has-text-centered">{{ vendors.length || 0 }}</span>
          <span class="type has-text-centered">Vendors</span>
        </div>
      </div>
      <div class="column">
        <div class="container-info">
          <span class="title is-4 has-text-centered">{{ products.length || 0 }}</span>
          <span class="type has-text-centered">Products</span>
        </div>
      </div>
      <div class="column">
        <div class="container-info">
          <span class="title is-4 has-text-centered">{{ categories.length || 0 }}</span>
          <span class="type has-text-centered">Category</span>
        </div>
      </div>
    </div>

    <section class="recent-topup-product__section">
      <div class="columns">
        <div class="column is-half">
          <requestTopup />
        </div>
        <div class="column is-half">
          <productReview />
        </div>
      </div>
    </section>

    <recentReview />

  </div>
</template>


<style lang="scss" scoped>
  .container-info {
    display: flex;
    flex-direction: column;

    span.type {
      font-size: 0.8rem;
    }
  }
  .recent-topup-product__section {
    min-height: 4rem;
    margin: 1rem 0;
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  const RecentReview = () => import('./RecentReview.vue')
  const RequestTopup = () => import('./RequestTopup.vue')
  const ProductReview = () => import('./ProductReview.vue')

  export default {
    components: {
      RecentReview,
      RequestTopup,
      ProductReview
    },
    computed: {
      ...mapGetters([
        'products',
        'vendors',
        'users',
        'categories',
        'reviews'
      ])
    }
  }
</script>
