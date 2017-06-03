<template>
  <div class="t_detail">
    <div class="t_head">
      <h1 class="title is-3">Transaksi : #{{ transaction.id }}</h1>
    </div>
    <div class="t_info_user">
      <div class="t_user">
        <p class="u_id">{{ transaction.user_id }}</p>
        <p class="u_name">Nipe Setiawan Harefa</p>
        <p class="u_email">nipeharefa@gmail.com</p>
        <p class="u_phone">+6282275121178</p>
      </div>
      <div class="t_shipping">
        <div class="s_address">
          <span>Jalan Flamboyan Raya No. 112 Medan</span>
        </div>
        <div class="s_zip_code">
          <span>220123</span>
        </div>
        <div class="s_phone">
          <span>+6282275121178</span>
        </div>
      </div>
    </div>
    <div class="t_table_order">
      <table class="table">

      </table>
    </div>
  </div>
</template>


<style lang="scss" scoped>
  @import "node_modules/bulma/bulma";
</style>

<script>
  export default {

    created () {
      this.getTransactionDetail()
    },
    data () {
      return {
        id: this.$store.state.route.params.id,
        transaction: {}
      }
    },
    methods: {
      getTransactionDetail () {
        this.$http.get(`api/admin/transaction/${this.id}`)
          .then(response => {
            this.transaction = response.data.transaction
          })
      }
    }
  }
</script>
