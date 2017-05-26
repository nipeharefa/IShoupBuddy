<template>
  <div class="modal modal-product-to-cart" :class="{'is-active': show}">
    <div class="modal-background"></div>
    <div class="modal-content">
      <div class="add-product-cart" v-if="product">
        <div class="image product-image-cart">
          <figure class="image">
            <img :src="product.picture_url['small']" :alt="product.name" >
          </figure>
        </div>
        <div class="cart-product__description">
          <div class="cart-product__name">
            <span>{{ product.name }}</span>
          </div>

          <div class="cart-price">
            <div class="product-satuan">
              <span>{{ product.minimum_price_string }}</span>
            </div>

            <div class="product-input__quantity">

              <div class="field has-addons">
                <p class="control" @click="add(false)">
                  <a class="button">
                    -
                  </a>
                </p>
                <p class="control">
                  <input class="input" type="text" placeholder="1" v-model="quas">
                </p>
                <p class="control" @click="add(true)">
                  <a class="button">
                    +
                  </a>
                </p>
              </div>
            </div>

            <div class="product-price__total">
              <span>{{ total }}</span>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-cart-footer">
        <div class="cart-table-order">
          <span>Total</span>
          <span>{{ total }}</span>
        </div>
      </div>
      <div class="modal-cart-action">
        <button class="button is-danger">
          Tambahkan ke Troli Belanja
        </button>
      </div>
    </div>
    <button class="modal-close" @click="hideModals"></button>
  </div>
</template>


<script>

  export default {
    mounted () {},
    props: ['product', 'show', 'product_vendor'],
    methods: {
      hideModals () {
        this.$emit('update:show', false)
      },
      add (param1) {
        if (param1) {
          this.quas = this.quas + 1
          return
        }
        this.quas = this.quas - 1
        return
      }
    },
    computed: {
      quas: {
        get () {
          return this.quantity
        },
        set (newValue) {
          if (parseInt(newValue) < 1) {
            this.quantity = 1
            return
          }
          this.quantity = newValue
          return
        }
      },
      total () {
        return this.quas * this.product_vendor.price
      }
    },
    data () {
      return {
        quantity: 1
      }
    }
  }
</script>
