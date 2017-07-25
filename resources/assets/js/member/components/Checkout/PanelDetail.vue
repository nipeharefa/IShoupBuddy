<template>
  <div>
    <div class="panel-block" v-for="product in cartItem">

      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img :src="product.product.picture_url.small">
          </p>
        </figure>
      </article>

      <div class="media-content">
        <div class="content">
          <div class="product-name">
            <p class="product-name">{{ product.product.name }}</p>
          </div>
        </div>

        <div class="quantity-control">
          <div class="field has-addons">
          </div>
          <div class="subtotal__container">
            <div class="subtotal__wrapper">
              <span class="subtotal__caption">Satuan</span>
              <span class="subtotal-text">{{ formattingPrice(product.satuan) }}</span>
            </div>
            <div class="subtotal__wrapper">
              <span class="subtotal__caption">Quantity</span>
              <span class="subtotal-text">{{ product.quantity }}</span>
            </div>
            <div class="subtotal__wrapper">
              <span class="subtotal__caption">SubTotal</span>
              <span class="subtotal-text">{{ formattingPrice(product.satuan * product.quantity) }}</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<style lang="scss" scoped>
  .subtotal__container {
    font-size: 0.85rem;
    .subtotal__wrapper,
    .subtotal__jarak,
    .subtotal__est_time {
      display: flex;
    }
  }
  .subtotal__caption {
    flex: 0.6
  }
  .subtotal-text {
    flex: 0.4;
    text-align: right;
  }
</style>

<script>
  import accounting from 'accounting-js'
  import { mapGetters, mapActions } from 'vuex'

  export default {
    props: {
      cartItem: {
        required: true
      },
      cartIndex: {
        required: true
      }
    },
    computed: {
      ...mapGetters(['cartChecked'])
    },
    methods: {
      ...mapActions(['updateBaru', 'updateCartChecked']),
      formattingPrice (price) {
        return accounting.formatMoney(price, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      },
      addQuantity (idItem, item) {
        const itemIndex = this.cartItem.findIndex(x => {
          return x.id === idItem
        })
        const cartIndex = this.cartIndex
        const quantity = item.quantity + 1
        const id = item.id
        const self = this
        this.$http.patch(`api/cart-detail/${id}`, {quantity}).then(response => {
          const update = {
            cartIndex,
            itemIndex,
            quantity: response.data.quantity
          }
          this.updateBaru(update)
          self.updateCartChecked(self.cartChecked)
        })
      },
      subQuantity (idItem, item) {

        const itemIndex = this.cartItem.findIndex(x => {
          return x.id === idItem
        })
        const cartIndex = this.cartIndex
        const quantity = item.quantity - 1
        const update = {
          cartIndex,
          itemIndex,
          quantity
        }
        if (quantity === 0) {
          return
        }
        const id = item.id

        this.$http.patch(`api/cart-detail/${id}`, {quantity}).then(response => {
          const update = {
            cartIndex,
            itemIndex,
            quantity: response.data.quantity
          }
          this.updateBaru(update)
          this.updateCartChecked(this.cartChecked)
        })
        return
      },
    }
  }
</script>
