<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama Vendor</th>
        <th>Email</th>
        <th>No. Hanphone</th>
        <th>Alamat</th>
        <th>Total Product</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in vendors">
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.phone }}</td>
        <td>{{ item.address }}</td>
        <td>{{ item.product_vendor_count }}</td>
        <td>{{ item.confirmed ? "Aktif" : "Belum Aktif" }}</td>
        <td>
          <a class="is-link"
            @click="activateVendor(item, index)" v-if="!item.confirmed">Aktifkan</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  import { mapGetters, mapActions } from 'vuex'

  import iziToast from 'izitoast'

  export default {
    data () {
      return {}
    },
    computed: {
      ...mapGetters([
        'vendors'
      ])
    },
    methods: {
      ...mapActions([
        'confirmVendor'
      ]),
      activateVendor (item, index) {
        console.log(index)
        const data = { 'product_id': item.id }
        const vendorName = item.name
        this.$http.post('api/vendor/activate', data).then(response => {
          iziToast.success({
              title: 'Sukses',
              message: `Vendor ${vendorName} berhasil di aktifkan`,
              position: 'bottomRight'
          });
          this.confirmVendor(index)

        }).catch(err => err)
      }
    }
  }
</script>
