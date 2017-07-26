<template>
  <div class="total-cart">
    <div class="cart-total__head">
      <small>Total Belanja</small>
      <span class="total">{{ totalString }}</span>
    </div>
    <div class="notification is-danger" v-if="onError">
      <button class="delete" @click="hideNotification"></button>
      {{ errorMessage }}
    </div>
    <div class="checkout_action">
      <button class="button is-primary" @click="bayar">Bayar</button>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .cart-total__head {
    display: flex;
    flex-direction: column;
    text-align: center;
    .total {
      font-weight: bolder;
      font-size: 2rem;
    }
  }
  .checkout_action {
    margin: 1rem 0;
    text-align: center;
  }
</style>

<script>

  import { mapGetters } from 'vuex'
  import accounting from 'accounting-js'

  export default {
    mounted() {
      const data = this.$store.state.carts.carts
      this.transaction.shipment = data.map( x => {
        return x.shipment.low_rates
      })
      this.transaction.cart_id = data.map( x => {
        return x.id
      })
      this.transaction.lat = this.$store.state.carts.shipment.lat
      this.transaction.lng = this.$store.state.carts.shipment.lng
    },
    data () {
      return {
        onError: false,
        errorMessage: '',
        transaction: {
          cart_id: null,
          shipment: [],
          lat: null,
          lng: null
        }
      }
    },
    computed: {
      ...mapGetters(['carts', 'cartsTotal', 'activeUser']),
      totalString () {
        return this.formattingPrice(this.cartsTotal)
      }
    },
    methods: {
      formattingPrice (price) {
        return accounting.formatMoney(price, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      },
      hideNotification () {
        this.onError = false
      },
      clearSession (btn) {
        const id = this.activeUser.id
        this.$http.delete(`checkout/${id}`).then(response => {
          window.location.assign('/me/transactions')
          // btn.classList.remove('is-loading')
        }).catch( err => {
          this.onError = true
          console.log(err.response.data)
          this.errorMessage = err.response.data.message
          btn.classList.remove('is-loading')
        })
      },
      bayar ($event) {
        const btn = $event.target
        const data = this.transaction
        this.onError = false

        btn.classList.add('is-loading')

        this.$http.post('api/transaction', data).then(response => {
          console.log(response)
          this.clearSession(btn)
        }).catch(err => {
          this.onError = true
          console.log(err.response.data)
          this.errorMessage = err.response.data.message
          btn.classList.remove('is-loading')
        })
      }
    }
  }
</script>
