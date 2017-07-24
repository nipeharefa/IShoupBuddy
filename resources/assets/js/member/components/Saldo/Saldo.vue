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
          <td>Waktu</td>
          <td>Nominal</td>
          <td>Status</td>
        </thead>
        <tbody>
          <tr>
            <td>17 Juli 2017 09.52 WIB</td>
            <td>Rp. 10.000</td>
            <td>Sukses</td>
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
  export default {
    components: {
      ModalAddSaldo
    },
    data () {
      return {
        show: false
      }
    },
    methods: {
      showSaldoModal () {
        this.show = true
      }
    }
  }
</script>
