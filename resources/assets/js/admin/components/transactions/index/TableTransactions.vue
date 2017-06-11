<template>
  <table class="table">
    <thead>
      <tr>
        <th>ID Transaksi</th>
        <th>User</th>
        <th>Nominal</th>
        <th>Type</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in transactions">
        <td>
          <router-link
          :to="{ name: 'detailTransaction', params: { id: item.id }}" append>
            {{ item.id }}
          </router-link>
        </td>
        <td>
          {{ item.user.id }}
        </td>
        <td>
          {{ item.nominal_string }}
        </td>
        <td>
          {{ item.type }}
        </td>
        <td>
          {{ item.status_string }}
        </td>
        <td>
          <a class="button is-small is-primary" @click="approve(item)"
          :disabled="item.status === 1 ? 'disabled' : false">Approve</a>
          <a class="button is-small is-danger">Cancel</a>
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
        'transactions'
      ])
    },
    methods: {
      approve (item) {
        if (item.type === 'Saldo') {
          this.approveSaldo(item)
          return
        }
      },
      approveSaldo (item) {
        this.$http.post(`api/admin/transaction/${item.id}/approve`).then(response => {
          const { data } = response
          console.log(data)
        }).catch(err => err)
      }
    }
  }
</script>
