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
            <span class="icon" @click="deleteItem(product)">
              <i class="fa "
              :class="{'fa-trash': !onDelete, 'fa-circle-o-notch fa-spin fa-3x fa-fw': onDelete}"></i>
            </span>
          </div>
        </div>

        <div class="quantity-control">
          <div class="field has-addons">
            <p class="control">
              <button class="button is-small" @click="subQuantity(product.id, product)">-</button>
            </p>
            <p class="control">
              <inputQuantity :rating.sync="product.quantity"
                v-on:rating-selected="updateQuantity(product.id, product)" />
            </p>
            <p class="control">
              <button class="button is-small" @click="addQuantity(product.id, product)">+</button>
            </p>
          </div>
          <div class="subtotal__container">
            <div class="subtotal__wrapper">
              <span class="subtotal__caption">Total</span>
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
  div.product-name {
    display: flex;
    justify-content: space-between;
  }
</style>

<script>
  import accounting from 'accounting-js'
  import { mapGetters, mapActions } from 'vuex'
  import InputQuantity from "./InputQuantity.vue"

  import debounce from 'lodash.debounce';

  export default {
    props: {
      cart: {
        required: true
      },
      cartItem: {
        required: true
      },
      cartIndex: {
        required: true
      }
    },
    data () {
      return {
        onDelete: false
      }
    },
    computed: {
      ...mapGetters(['cartChecked', 'carts'])
    },
    components: {
      InputQuantity
    },
    methods: {
      ...mapActions(['updateBaru', 'updateCartChecked']),
      syncQuantity: debounce((self, idItem, item) => {
        const itemIndex = self.cartItem.findIndex(x => {
          return x.id === idItem
        })
        const cartIndex = self.cartIndex
        const quantity = item.quantity
        const id = item.id
        self.$http.patch(`api/cart-detail/${id}`, {quantity}).then(response => {
          const update = {
            cartIndex,
            itemIndex,
            quantity: response.data.quantity
          }
          self.updateBaru(update)
          self.updateCartChecked(self.cartChecked)
        })
      }, 600),
      formattingPrice (price) {
        return accounting.formatMoney(price, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      },
      reQuantity: debounce((self, id, quantity, update) => {
        self.$http.patch(`api/cart-detail/${id}`, {quantity}).then(response => {
          update.quantity = response.data.quantity
          self.updateBaru(update)
          self.updateCartChecked(self.cartChecked)
        })
      }, 800),
      addQuantity (idItem, item) {
        const itemIndex = this.cartItem.findIndex(x => {
          return x.id === idItem
        })
        const cartIndex = this.cartIndex
        const quantity = item.quantity + 1
        const id = item.id
        const self = this
        const update = {
          cartIndex,
          itemIndex,
          quantity
        }
        this.reQuantity(self, id, quantity, update)
        this.updateBaru(update)
        // self.updateCartChecked(self.cartChecked)
      },
      subQuantity (idItem, item) {

        if (item.quantity > 1) {
          const itemIndex = this.cartItem.findIndex(x => {
            return x.id === idItem
          })
          const cartIndex = this.cartIndex

          const quantity = item.quantity - 1
          const id = item.id
          const self = this
          const update = {
            cartIndex,
            itemIndex,
            quantity
          }
          this.reQuantity(self, id, quantity, update)
          this.updateBaru(update)
        }
      },
      deleteCartWhenNullItem() {
        if (!this.cart.item.length) {
          const cartIndex  = this.carts.findIndex( x => {
            return x.id === this.cart.id
          })

          console.log(cartIndex)
          this.carts.splice(cartIndex, 1)
        }
        return
      },
      deleteItem (item) {
        console.log(item)
        this.onDelete = true
        const cId = this.cart.id
        const iId = item.id

        this.$http.delete(`api/cart/${cId}/detail/${iId}`).then(response => {

          const itemIndex = this.cart.item.findIndex(x => {
            return x.id === item.id
          })
          this.onDelete = false

          this.cart.item.splice(itemIndex, 1)
          this.deleteCartWhenNullItem()

        }).catch(err => err)
      },
      updateQuantity(product, i) {
        const self = this
        this.syncQuantity(self, product, i)
      }
    }
  }
</script>
