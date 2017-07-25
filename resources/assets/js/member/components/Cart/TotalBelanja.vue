<template>
  <div class="total-cart">
    <div class="cart-total__head">
      <small>Total Belanja</small>
      <span class="total">{{ totalString }}</span>
    </div>
    <div class="cart-total__body"></div>
    <div class="shipment-address">
      <div class="field">
        <label for="">Alamat Pengiriman</label>
        <textarea class="input shipment-address__textarea" v-model="shipmentAddress" v-if=""></textarea>
        <button class="button is-small is-primary button-pick__maps" @click="showPickMaps">Pilih Lokasi</button>
      </div>
    </div>
    <div class="button-payment">
      <button class="button is-primary" @click="checkout" :disabled="!canCheckout">Lanjutkan ke Pembayaran</button>
    </div>
    <modalPickLocation :isActive.sync="onModalShow"
        :latitude.sync="shipment.lat" :longitude.sync="shipment.lng"/>
  </div>
</template>

<style lang="scss" scoped>
  div.shipment-address {
    margin: 1rem 0;
  }
  div.shipment-address {
    label {
      font-size: 0.85rem;
    }
    textarea {
      height: 4rem;
    }
  }
  .button-pick__maps {
    margin: 1rem 0;
  }

  .cart-total__head {
    display: flex;
    flex-direction: column;
    text-align: center;
    .total {
      font-weight: bolder;
      font-size: 2rem;
    }
  }
</style>

<script>
  import { mapGetters } from 'vuex'
  const ModalPickLocation = () => import('global/components/Modals/ModalPickLocation.vue')

  export default {
    props: {
      cartChecked: {
        required: true
      },
      total: {
        required: true
      },
      totalString: {
        required: true
      }
    },
    computed: {
      ...mapGetters(['activeUser']),
      canCheckout () {
        return this.cartChecked.length > 0
      },
      invalidAddress () {
        return this.shipment.lat === null || this.shipment.lng
      }
    },
    components: {
      ModalPickLocation
    },
    mounted () {
      this.shipment.lat = this.activeUser.latitude
      this.shipment.lng = this.activeUser.longitude
    },
    data () {
      return {
        shipment: {
          lat: null,
          lng: null
        },
        shipmentAddress: null,
        onModalShow: false
      }
    },
    methods: {
      checkout () {
        const data = {
          cart: this.cartChecked,
          shipment: this.shipment
        }
        this.$http.post('checkout', data).then(response => {
          console.log(response)
        })
      },
      showPickMaps () {
        this.onModalShow = true
        console.log('sadfsladkfjasdlkfjadlk')
      },
      hideModalsMaps() {
        this.onModalShow = false
      }
    },
  }
</script>
