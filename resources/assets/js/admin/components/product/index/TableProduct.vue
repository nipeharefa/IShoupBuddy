<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Produk</th>
        <th>Barcode</th>
        <th>Rating / Ulasan</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in products">
        <td>{{ item.name }}</td>
        <td>{{ item.barcode }}</td>
        <td>0 / 0</td>
        <td>
          <a href="">Edit</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters([
        'products'
      ])
    }
  }
</script>
