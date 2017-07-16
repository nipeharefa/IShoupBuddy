<template>
  <table class="table">
    <thead>
      <td>Tanggal</td>
      <td>Nama Produk</td>
      <td>Vendor</td>
      <td>Rating</td>
      <td>Deskripsi</td>
    </thead>
    <tbody>
      <tr v-for="item in reviews">
        <td>2 Januari 2010</td>
        <td>{{ item.product.name }}</td>
        <td>{{ item.vendor.name }}</td>
        <td>{{ item.rating }}</td>
        <td>{{ item.body }}</td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  export default {
    props: {
      reviews: {
        required: true,
        type: Array
      }
    }
  }
</script>
