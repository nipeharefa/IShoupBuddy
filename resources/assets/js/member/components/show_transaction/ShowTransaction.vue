<template>
  <div>

    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'tableTransaction' }" append>
            Transaksi
          </router-link>
        </li>
        <li class="is-active"><a>#{{ transaction.id }}</a></li>
      </ul>
    </nav>

    <div class="t_detail">
      <div class="t_head">
        <h1 class="title is-3">Transaksi : #{{ transaction.id }}</h1>
      </div>

      <div class="t_table_order">
        <table-item v-if="transaction.detail" :transaction="transaction.detail"></table-item>
      </div>
    </div>

    <div class="t_shipment" v-if="!transaction.shipment.accepted_at">
      <small>Konfirmasi Penerimaan Barang</small>
      <br>
      <button class="button is-primary" @click="confirm">Konfirmasi Terima Barang</button>
    </div>

     <div class="t_shipment" v-if="transaction.shipment.accepted_at">
     <small>Konfirmasi Penerimaan Barang</small>
      <br>
      <b>Barang sudah diterima</b>
    </div>

  </div>
</template>

<style lang="scss">
  @import "~sassPages/admin/transactions/show";
</style>

<script>

  import { mapGetters, mapActions } from 'vuex'
  import iziToast from 'izitoast'
  const TableItem = () => import ('./TableDetailTransaction.vue')

  export default {
    created () {
      this.getTransaction()
    },
    components: {
      TableItem
    },
    computed: {
      ...mapGetters([
        'activeUser',
        'transactions',
        'transaction',
      ])
    },
    data () {
      return {
        id: this.$store.state.route.params.id,
      }
    },
    methods: {
      ...mapActions([
        'initTransaction'
      ]),
      confirm ($event) {
        const id = this.transaction.shipment.id
        const data = this.user
        const btn = event.target
        btn.classList.add('is-loading')
        this.$http.post(`api/transaction-shipment/postAcceptShipment/${id}`)
          .then(response => {
            iziToast.success({
              title: 'Sukses',
              message: 'Konfirmasi berhasil',
              position: 'bottomRight'
            });
            btn.classList.remove('is-loading')
            this.transaction.shipment.accepted_at = true
          }).catch(err => {
            btn.classList.remove('is-loading')
          })
      },
      getTransaction() {
        const index = this.transactions.findIndex(x => {
          return x.id == this.id
        })

        if (true) {
          this.initTransaction(this.transactions[index])
          return;
        }
        this.$router.push({name: 'tableTransaction'})
        return

      }
    }
  }

</script>
