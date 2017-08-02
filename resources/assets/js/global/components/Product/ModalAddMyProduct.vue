<template>
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-content">
      <!-- Any other Bulma elements you want -->
      <div class="form">
        <div class="field">
          <label class="label">Name</label>
          <p class="control">
            <input class="input" type="text" placeholder="Text input" disabled v-model="dataForm.name">
          </p>
        </div>

        <div class="field">
          <label class="label">Barcode</label>
          <p class="control">
            <input class="input" type="text" placeholder="Barocede" disabled v-model="dataForm.barcode">
          </p>
        </div>

        <div class="field">
          <label for="">Harga</label>
          <p class="control">
            <input class="input" type="text" placeholder="Harga"
            v-model="newPrice"
            :value="amountValue"
            @input="processValue(amountValue)"
            >
          </p>
        </div>

        <div class="field">
          <button class="button is-primary" @click="savePrice($event)">Simpan</button>
        </div>

      </div>
    </div>
    <button class="modal-close" @click="hideAction"></button>
  </div>
</template>

<style lang="scss" scoped>
  .modal-background {
    background: rgba(255,255,255,1) !important;
  }
  .modal-close {
    background-color: rgba(0, 0, 0, 0.2) !important;
  }
</style>


<script>
  import iziToast from 'izitoast'
  import { mapActions } from 'vuex'

  export default {
    props: {
      price: {
        default: 0
      },
      data: Object,
      addData: Function,
      addedProduct: Function,
      modalShow: Boolean
    },
    computed: {
      amountValue () {
        return this.formatToNumber(this.newPrice)
      }
    },
    data () {
      return {
        dataForm: this.data,
        newPrice: this.price
      }
    },
    methods: {
      ...mapActions(['addOwnProduct']),
      processValue(value){
        if (isNaN(value)) {
          this.newPrice = 1
          return
        } else if (value === 0) {
          this.newPrice = 1
        } else {
          this.newPrice = value
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
      },
      hideAction () {
        this.$emit('update:modalShow', false)
      },
      savePrice (event) {
        const a = event.target
        const data = {
          productID: this.dataForm.id,
          price: this.newPrice
        }
        a.classList.add('is-loading')
        this.$http.post('api/product-vendor', data).then(response => {
          a.classList.remove('is-loading')
          this.addOwnProduct(response.data.product)
          this.hideAction()
          iziToast.success({
            title: 'Sukses',
            message: 'Produk berhasil ditambahkan',
            position: 'bottomRight'
          })
          this.$router.push({name: 'product-index'})
          this.data.used = true
        }).catch(err => {
          a.classList.remove('is-loading')
        })
      }
    }
  }
</script>
