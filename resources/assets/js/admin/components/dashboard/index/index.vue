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

    <section class="recent-review__section">
      <div class="recent-review__head">
        <p>Recent Review</p>
      </div>
      <div class="recent-review__body">
        <table class="recent-revie__table">
          <thead>
            <td>Tanggal</td>
            <td>Deskripsi</td>
          </thead>
          <tbody>
            <tr v-for="item in reviews">
              <td>{{ item.date }}</td>
              <td>{{ item.user.name }} memberi review ke produk {{ item.product.name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

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
        'categories',
        'reviews'
      ])
    }
  }
</script>
