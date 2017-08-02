<template>
  <div class="modal modal-product-to-cart" :class="{'is-active': show}">
    <div class="modal-background" @click="hideModals"></div>
    <div class="modal-card">
    <header class="modal-card-head">
      <!-- <p class="modal-card-title">Modal title</p> -->
      <button class="delete" @click="hideModals"></button>
    </header>
      <section class="modal-card-body">
        <div class="c_info" v-if="!onSuccess">

          <div class="c_info_vendor" v-if="product_vendor.vendor">
           <p>{{ product_vendor.vendor.name }}</p>
          </div>
          <div class="c_info_product">
            <div class="c_product_image">
              <figure class="image is-128x128">
                <img :src="product.picture_url.medium">
              </figure>
            </div>
            <div class="c_product_price">
              <div class="c_product__name">
                <span>{{ product.name }}</span>
              </div>
              <div class="c_product__quantity">
                <span class="product__price">{{ product_vendor.price_string }}</span>
                <div class="field has-addons has-addons-centered quantity__control">
                  <p class="control" @click="add(false)">
                    <a class="button is-info">-</a>
                  </p>
                  <p class="control">
                    <input class="input" type="text"
                    placeholder="1"
                    v-model="quantity"
                    :value="amountValue"
                    @input="processValue(amountValue)">
                  </p>
                  <p class="control" @click="add(true)">
                    <a class="button is-info">+</a>
                  </p>
                </div>
                <span class="total">
                  {{ total }}
                </span>
              </div>
            </div>
          </div>

        </div>

        <div class="cart-success" v-if="onSuccess">
          <h1><b>{{ product.name }}</b> berhasil ditambahkan ke keranjang belanja</h1>
          <a href="/cart" class="is-small">Lihat Keranjang Belanja</a>
        </div>
      </section>
      <footer class="modal-card-foot">
        <a class="button is-danger" @click="addToCart($event)" v-if="!onSuccess">Tambahkan ke Keranjang Belanja</a>
        <a class="button is-danger" @click="hideModals" v-if="onSuccess">Tutup</a>
        <!-- <a class="button">Cancel</a> -->
      </footer>
    </div>
  </div>
</template>


<script>

  import accounting from 'accounting-js'
  import { mapActions, mapGetters } from 'vuex'

  export default {
    mounted () {},
    props: ['product', 'show', 'product_vendor'],
    methods: {
      ...mapActions(['setTotalCart']),
      addToCart (event) {
        const btnUpdate = event.target
        const data = {
          'product_vendor_id': this.product_vendor.id,
          'quantity': this.quantity
        }
        btnUpdate.classList.add('is-loading')
        this.$http.post('api/cart', data).then(response => {
          btnUpdate.classList.remove('is-loading')
          this.onSuccess = true
        }).catch(err => {
          btnUpdate.classList.remove('is-loading')
        })
      },
      hideModals () {
        this.$emit('update:show', false)
        this.onSuccess = false
        this.updateTotalCart()
      },
      updateTotalCart () {
        const id = this.activeUser.id
        this.$http.get(`/api/user/${id}/cartscounter`).then(response => {
          this.setTotalCart(response.data.cart)
        }).catch(err => err)
      },
      add (param1) {
        if (param1) {
          this.quas = this.quas + 1
          return
        }
        this.quas = this.quas - 1
        return
      },
      processValue(value){
        if (isNaN(value)) {
          this.quantity = 1
          return
        } else if (value === 0) {
          this.quantity = 1
        } else {
          this.quantity = value
        }
      },
      formatToNumber (value) {
        let number = 0
        if (this.separator === '.') {
          let cleanValue = value
          if (typeof value !== 'string') {
            cleanValue = this.numberToString(value)
          }
          number = Number(String(cleanValue).replace(/[^0-9-,]+/g, '').replace(',', '.'))
        } else {
          number = Number(String(value).replace(/[^0-9-.]+/g, ''))
        }
        if (!this.minus) return Math.abs(number)
        return number
      }
    },
    computed: {
      ...mapGetters(['activeUser']),
      amountValue () {
        return this.formatToNumber(this.quantity)
      },
      total () {
        const t =  this.quantity * this.product_vendor.price
        return accounting.formatMoney(t, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      }
    },
    data () {
      return {
        quantity: 1,
        onSuccess: false
      }
    }
  }
</script>
