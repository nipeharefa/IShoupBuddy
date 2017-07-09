<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th><abbr title="Position">ID</abbr></th>
          <th><abbr title="Position">Nama Produk</abbr></th>
          <th><abbr title="Position">Nominal</abbr></th>
          <th><abbr title="Position">Status</abbr></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in transactions">
          <td class="item-id-transaction">
            <a href="/me/transactions/0000011">{{ item.id }}</a>
          </td>
          <td>
            <span v-for="d in item.detail">{{ d.name }}</span>
          </td>
          <td>{{ item.nominal_string }}</td>
          <td>
            <span class="tag is-success">
              <i class="fa fa-check-circle"></i>
            </span>
          </td>
        </tr>

        <tr class="no-data" v-if="!transactions">
          <td colspan="4">Tidak Ada Transaksi</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style lang="scss">
  tr.no-data {
    td {
      font-size: 0.85rem;
      text-align: center;
    }
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters(['transactions'])
    }

  }
</script>
