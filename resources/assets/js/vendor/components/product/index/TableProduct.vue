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
        <td>{{ item.total_review || 0}} / {{ item.avg_rating || 0 }}</td>
        <td>{{ item.vendors.length }}</td>
        <td>
          <a class="button is-small" title="Add to My Product" :disabled="item.used">
            <i class="fa fa-plus"></i>
          </a>
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
