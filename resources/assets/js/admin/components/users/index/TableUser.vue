<template>
  <table class="table">
    <thead>
      <tr>
        <th>Nama User</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Saldo</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in users">
        <td>
          <router-link :to="{ name: 'showUser', params: { id: item.id } }" append>
            {{ item.name }}
          </router-link>
        </td>
        <td>{{ item.email }}</td>
        <td>{{ item.phone }}</td>
        <td>{{ item.saldo.saldo_string }}</td>
        <td></td>
      </tr>
    </tbody>
  </table>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: 'TableListUser',
    computed: {
      ...mapGetters([
        'users'
      ])
    }
  }
</script>
