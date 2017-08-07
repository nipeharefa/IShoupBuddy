<template>
  <section class="recent-review__section">
    <div class="recent-review__head">
      <p>Recent Review</p>
    </div>
    <div class="recent-review__body">
      <table class="table recent-revie__table">
        <thead>
          <td>Tanggal</td>
          <td>Deskripsi</td>
        </thead>
        <tbody>
          <tr v-for="item in reviews.slice(0,10)">
            <td>{{ item.date_string }}</td>
            <td>{{ item.user.name }} memberi review ke produk {{ item.product.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

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
