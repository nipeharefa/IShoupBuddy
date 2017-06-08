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
      <tr v-for="item in vendors">
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
        <td>{{ item.phone }}</td>
        <td></td>
        <td>{{ item.total_product }}</td>
        <td>{{ item.confirmed ? "Aktif" : "Belum Aktif" }}</td>
        <td>
          <button class="button is-link"
            @click="activateVendor(item.id)" v-if="!item.confirmed">Aktifkan</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<script>
  import { mapGetters } from 'vuex'
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
      activateVendor (id) {
        const data = { 'product_id': id }
        this.$http.post('api/vendor/activate', data).then(response => {
          console.log(response)
        }).catch(err => err)
      }
    }
  }
</script>
