<template>
  <div>
    <div>
      <h1 class="title is-4">Transaksi #00001</h1>
      <hr>
    </div>
    <div>
      <table class="table">
        <thead>
          <tr>
            <th></th>
            <th><abbr title="Position">Nama Produk</abbr></th>
            <th><abbr title="Position">Qty</abbr></th>
            <th><abbr title="Position">Harga Satuan</abbr></th>
            <th><abbr title="Position">Jumlah</abbr></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in 5">
            <td>{{ item }}</td>
            <td>Sayur Putih Pertamax</td>
            <td>10</td>
            <td>10.000</td>
            <td>100.000</td>
          </tr>
        </tbody>
      </table>
      <small>Total Belanja</small><h1><b>Rp. 1.000.000</b></h1>
    </div>
    <div>
      <shipping-information></shipping-information>
    </div>
  </div>
</template>


<script>
  const ShippingInformation = () => import('./ShippingInformation.vue')

  export default {
    components: {
      ShippingInformation
    }
  }
</script>
