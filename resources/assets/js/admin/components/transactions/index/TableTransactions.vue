<template>
  <table class="table">
    <thead>
      <tr>
        <th>ID Transaksi</th>
        <th>User</th>
        <th>Nominal</th>
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
          {{ item.user_id }}
        </td>
        <td>
          {{ item.nominal }}
        </td>
        <td>
          Success
        </td>
        <td>
          <a class="button is-small is-primary">Approve</a>
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
    }
  }
</script>
