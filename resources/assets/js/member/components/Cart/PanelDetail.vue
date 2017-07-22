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
          <div class="subtotal">
            <span>{{ formattingPrice(product.price * product.quantity) }}</span>
            <i class="fa fa-trash" @click="deleteItem(item.id, product.id)"></i>
          </div>
        </div>

        <div class="quantity-control">
          <div class="field has-addons">
            <p class="control">
              <button class="button is-small" @click="subQuantity(product.id, product)">-</button>
            </p>
            <p class="control">
              <input class="input is-small in-quan"
              type="text" placeholder="1" v-model="product.quantity">
            </p>
            <p class="control">
              <button class="button is-small" @click="addQuantity(product.id, product)">+</button>
            </p>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>


<script>
  import accounting from 'accounting-js'
  import { mapActions } from 'vuex'

  export default {
    props: {
      cartItem: {
        required: true
      },
      cartIndex: {
        required: true
      }
    },
    methods: {
      ...mapActions(['updateBaru']),
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

        this.$http.patch(`api/cart-detail/${id}`, {quantity}).then(response => {
          const update = {
            cartIndex,
            itemIndex,
            quantity: response.data.quantity
          }
          this.updateBaru(update)
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
        })
        return
      },
    }
  }
</script>
