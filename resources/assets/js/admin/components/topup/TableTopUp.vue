<template>
  <div>
    <table class="table">
      <thead>
        <td>ID Transaksi</td>
        <td>Pengguna</td>
        <td>Nominal</td>
        <td>Status</td>
        <td>Keterangan</td>
      </thead>
      <tbody>
        <tr v-for="item in topup">
          <td>{{ item.id }}</td>
          <td>{{ item.user.name }}</td>
          <td>{{ item.nominal_string }}</td>
          <td>
            <a class="button is-small is-primary" @click="approve(item, $event)"
            :disabled="item.status === 1 ? 'disabled' : false">Approve</a>
            <a class="button is-small is-danger"
            :disabled="cancelState(item) ? 'disabled' : false" @click="cancelTopUp(item, $event)">Cancel</a>
          </td>
          <td>{{ item.status_string }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

  import iziToast from 'izitoast'
  export default {
    props: {
      topup: {
        required: true,
        type: Array
      }
    },
    methods: {
      cancelState (item) {
        if (item.status === 1 || item.status === 4) {
          return true
        }
        return false
      },
      approve (item, event) {
        if (item.status === 1) {
          return;
        }
        const btnUpdate = event.target
        btnUpdate.classList.add('is-loading')
        this.$http.post(`api/admin/transaction/${item.id}/approve`).then(response => {
          iziToast.success({
            title: 'Sukses',
            message: 'Topup disetujui',
            position: 'bottomRight'
          })
          btnUpdate.classList.remove('is-loading')
          item.status = 1
        }).catch(err => {
          iziToast.error({
            title: 'Error',
            message: 'Terjadi Kesalahan',
            position: 'bottomRight'
          })
          btnUpdate.classList.remove('is-loading')
        })
      },
      cancelTopUp(item, event) {
        if (item.status === 1 || item.status === 4) {
          return false
        }
        const btnUpdate = event.target
        btnUpdate.classList.add('is-loading')
        this.$http.post(`api/admin/transaction/${item.id}/cancel`).then(response => {
          iziToast.success({
            title: 'Sukses',
            message: 'Topup dibatalkan',
            position: 'bottomRight'
          })
          btnUpdate.classList.remove('is-loading')
          item.status = 4
        }).catch(err => {
          iziToast.error({
            title: 'Error',
            message: 'Terjadi Kesalahan',
            position: 'bottomRight'
          })
          btnUpdate.classList.remove('is-loading')
        })
      }
    }
  }
</script>
