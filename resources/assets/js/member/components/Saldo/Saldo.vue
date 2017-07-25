<template>
  <div id="saldo">
    <div class="saldo_head">
      <div class="saldo-amount">
        <small>Total Saldo</small>
        <strong>Rp.</strong>
      </div>
      <div class="saldo-add">
        <button class="button is-small saldo-add__btn" @click="showSaldoModal">Tambah Saldo</button>
      </div>
    </div>

    <div class="saldo_body">
      <table class="table">
        <thead>
          <td>Id</td>
          <td>Waktu</td>
          <td>Nominal</td>
          <td>Status</td>
        </thead>
        <tbody>
          <tr v-for="item in saldoTransactions">
            <td>
              <router-link :to="{ name: 'detailSaldo', params: { id: item.id } }" append>
                  #{{ item.id }}
              </router-link>
            </td>
            <td>{{ item.updated_at }}</td>
            <td>{{ item.nominal_string }}</td>
            <td>{{ item.status_string }}</td>
          </tr>
        </tbody>
      </table>
    </div>

   <modalAddSaldo :show.sync="show" v-if="show"/>
  </div>
</template>

<style lang="scss" scoped>
  .saldo_head {
    display: flex;
  }
</style>


<script>
  const ModalAddSaldo = () => import('./ModalAddSaldo.vue')
  import { mapGetters } from 'vuex'

  export default {
    components: {
      ModalAddSaldo
    },
    data () {
      return {
        show: false
      }
    },
    computed: {
      ...mapGetters(['saldoTransactions'])
    },
    methods: {
      showSaldoModal () {
        this.show = true
      }
    }
  }
</script>
