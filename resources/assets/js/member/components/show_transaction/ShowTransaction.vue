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
        <span class="tag" :class="colorStatus">{{ statusText }}</span>
      </div>

      <div class="t_table_order">
        <table-item v-if="transaction.detail" :transaction="transaction.detail"></table-item>
      </div>

      <div class="columns">
        <div class="column is-half">
          <h1>Informasi Pengiriman</h1>
          <mapsPengiriman  :latitude="transaction.shipment.lat" :longitude="transaction.shipment.lng" />
          <span>{{ address }}</span>
        </div>
      </div>
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
  const MapsPengiriman = () => import('./MapsPengiriman.vue')

  export default {
    created () {
      this.getTransaction()
      this.getAddress()
    },
    components: {
      TableItem,
      MapsPengiriman
    },
    computed: {
      ...mapGetters([
        'activeUser',
        'transactions',
        'transaction',
      ]),
      colorStatus() {
        const status = this.transaction.status
        if (status) {
          return "is-primary"
        }
        return "is-info"
      },
      statusText() {
        const status = this.transaction.status
        if (status) {
          return "Berhasil, barang telah diterima"
        }
        return "Pending"
      }
    },
    data () {
      return {
        id: this.$store.state.route.params.id,
        address: null
      }
    },
    methods: {
      ...mapActions([
        'initTransaction'
      ]),
      getAddress() {
        const self = this
        const latLng = {
          lat: this.transaction.shipment.lat || 3.590336,
          lng: this.transaction.shipment.lng || 98.6774813
        }

        const geocoder = new google.maps.Geocoder()

        geocoder.geocode({ 'latLng': latLng }, (results, status) => {
          if (status === google.maps.GeocoderStatus.OK) {
            const result = results[0]
            self.address = result.formatted_address
            console.log(result)
          } else {
            console.warn(result)
          }
        })
      },
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
