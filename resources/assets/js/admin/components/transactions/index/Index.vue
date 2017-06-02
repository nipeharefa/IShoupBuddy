<template>
  <div>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <admin-sidebar></admin-sidebar>
            </div>
            <div class="column">
              <tableTransactions />
            </div>
          </div>
        </div>
      </section>
    </div>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const TableTransactions = () => import('./TableTransactions.vue')
  const AdminSidebar = () => import('otherComponents/Sidebars/AdminSidebar.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    mounted() {
      this.getTransactions()
    },
    components: {
      FooterApps,
      AdminSidebar,
      TableTransactions
    },
    data () {
      return {
        transactions: []
      }
    },
    methods: {
      ...mapActions([
        'initTransactions'
      ]),
      getTransactions () {
        this.$http.get('api/admin/transaction').then(response => {
          this.transaction = response.data.transactions
          this.initTransactions(response.data.transactions)
        }).catch(err => err)
      }
    }
  }
</script>
