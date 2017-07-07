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
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {

    computed: {
      ...mapGetters([
        'products',
        'vendors',
        'users',
        'categories'
      ])
    }
  }
</script>
