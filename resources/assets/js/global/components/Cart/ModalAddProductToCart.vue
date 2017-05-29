<template>
  <div class="modal modal-product-to-cart" :class="{'is-active': show}">
    <div class="modal-background"></div>
    <div class="modal-card">
    <header class="modal-card-head">
      <!-- <p class="modal-card-title">Modal title</p> -->
      <button class="delete" @click="hideModals"></button>
    </header>
      <section class="modal-card-body">
        <div class="c_info">

          <div class="c_info_vendor">
           <p>Nama Vendor</p>
           <p>DKI Jakarta</p>
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
                    <input class="input" type="text" placeholder="1" v-model="quas">
                  </p>
                  <p class="control" @click="add(true)">
                    <a class="button is-info">+</a>
                  </p>
                </div>
                <span class="total">
                  Rp. {{ total }}
                </span>
              </div>
            </div>
          </div>

        </div>
      </section>
      <footer class="modal-card-foot">
        <a class="button is-danger" @click="addToCart">Tambahakan ke Keranjang Belanja</a>
        <!-- <a class="button">Cancel</a> -->
      </footer>
    </div>
  </div>
</template>


<script>

  export default {
    mounted () {},
    props: ['product', 'show', 'product_vendor'],
    methods: {
      addToCart () {
        const data = {
          'product_id': this.product.id,
          'vendor_id': this.product_vendor.vendor.id,
          'quantity': this.quantity
        }
        console.log(data)
        this.$http.post('api/cart', data).then(response => {
          console.log(response.data)
        }).catch(err => err)
      },
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
