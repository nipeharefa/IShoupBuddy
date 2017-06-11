<template>
  <table class="table">
    <thead>
      <tr>
        <td></td>
        <td>Nama Item</td>
        <td>Quantity</td>
        <td>Satuan</td>
        <td>Total</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in transaction">
        <td>{{ index + 1}}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.quantity }}</td>
        <td>{{ item.harga_string }}</td>
        <td>{{ item.total_string }}</td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  export default {
    props: ['transaction']
  }
</script>
