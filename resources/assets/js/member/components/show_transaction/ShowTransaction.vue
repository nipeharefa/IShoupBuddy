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

    <!-- <section class="order_details__shipping">
      <div class="columns">
        <div class="column is-half order_details__user">
          <b>Pengiriman</b>
          <table class="table">
            <tbody>
              <tr>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="column is-half"></div>
      </div>
    </section> -->

  </div>
</template>

<style lang="scss">
  @import "~sassPages/admin/transactions/show";
</style>

<script>
  import { mapGetters, mapActions } from 'vuex'
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
