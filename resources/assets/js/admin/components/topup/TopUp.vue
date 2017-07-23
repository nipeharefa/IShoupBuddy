<template>
  <div>
    <div class="topup__head">
      <breadCrumb />
    </div>
    <div class="topup__body">
      <tableTopup :topup="topup" />
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  const TableTopup = () => import('./TableTopUp.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')

  export default {
    components: {
      TableTopup,
      BreadCrumb
    },
    computed: {
      ...mapGetters([
        'transactions'
      ]),
      topup () {
        if (this.transactions) {
          return this.transactions.filter(x => {
            return x.type === "Saldo" && x.debit_credit === 0
          })
        }
        return null;
      }
    }
  }
</script>
