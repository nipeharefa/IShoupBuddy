<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Vendor</th>
        <th>Email</th>
        <th>No. Hanphone</th>
        <th>Alamat</th>
        <th>Terdaftar tanggal</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in vendors">
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.phone }}</td>
        <td></td>
        <td>{{ item.created_at }}</td>
        <td>{{ item.confirmed == 1 ? "Aktif" : "Belum Aktif" }}</td>
        <td>
          <button class="button is-link" @click="activateVendor(item.id)">Aktifkan</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  export default {
    props: ['vendors'],
    methods: {
      activateVendor (id) {
        const data = { 'product_id': id }
        this.$http.post('api/vendor/activate', data).then(response => {
          console.log(response)
        }).catch(err => err)
      }
    }
  }
</script>
