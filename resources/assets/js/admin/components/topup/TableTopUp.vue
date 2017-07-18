<template>
  <div>
    <table class="table">
      <thead>
        <td>ID Transaksi</td>
        <td>Pengguna</td>
        <td>Nominal</td>
        <td>Status</td>
      </thead>
      <tbody>
        <tr v-for="item in topup">
          <td>{{ item.id }}</td>
          <td>{{ item.user.name }}</td>
          <td>{{ item.nominal_string }}</td>
          <td>
            <a class="button is-small is-primary" @click="approve(item)"
            :disabled="item.status === 1 ? 'disabled' : false">Approve</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    props: {
      topup: {
        required: true,
        type: Array
      }
    },
    methods: {
      approve (item) {
        if (item.status === 1) {
          return;
        }
      }
    }
  }
</script>
