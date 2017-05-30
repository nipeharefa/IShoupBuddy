<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Barcode</th>
        <th>Rating</th>
        <th>Total Vendor</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in products">
        <td>{{ item.name }}</td>
        <td>{{ item.barcode }}</td>
        <td>{{ item.total_review }} / {{ item.avg_rating || 0 }}</td>
        <td>{{ item.total_vendor }}</td>
        <td>
          <a class="is-link" :href="`/admin/product/${item.id}/edit`">Edit</a>
          <a class="is-link is-danger">Hide</a>
        </td>
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
        'products'
      ])
    }
  }
</script>
