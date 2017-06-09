<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Barcode</th>
        <th>Rating</th>
        <th>Harga</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in ownProducts">
        <td>{{ item.name }}</td>
        <td>{{ item.barcode }}</td>
        <td>{{ item.total_review || 0 }} / {{ item.avg_rating || 0 }}</td>
        <td>{{ item.price_string }}</td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    props: ['role'],
    computed: {
      ...mapGetters([
        'ownProducts'
      ])
    }
  }
</script>
