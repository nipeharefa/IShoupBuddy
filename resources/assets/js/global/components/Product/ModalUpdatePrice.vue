<template>
  <div class="modal is-active">
    <div class="modal-background" @click="hideAction(null)"></div>
    <div class="modal-content">
      <div class="form">

        <div class="field">
          <label for="" class="label">Nama Product</label>
          <input type="text" class="input" disabled="" v-model="product.name">
        </div>

        <div class="field">
          <label for="" class="label">Harga Saat ini</label>
          <input type="text" class="input" v-model="product.price" disabled="disabled">
        </div>

        <div class="field">
          <label for="" class="label">Harga Terbaru</label>
          <input type="text" class="input"
          v-model="newPrice"
          :value="amountValue"
          @input="processValue(amountValue)"
            >
        </div>

        <div class="field">
          <button class="button is-primary is-small" @click="savePrice($event)">Simpan</button>
        </div>

      </div>
    </div>
    <button class="modal-close" @click="hideAction(null)"></button>
  </div>
</template>

<style lang="scss" scoped>
  .modal-background {
    background: rgba(206, 206, 206, 0.6) !important;
  },
  .modal-content {
    padding: 2rem !important;
    background: white !important;
  },
  .modal-close {
    background-color: rgba(0, 0, 0, 0.2) !important;
  }
</style>


<script>

  import { mapActions } from 'vuex'
  import iziToast from 'izitoast'

  export default {
    props: {
      visible: Boolean,
      hideAction: Function,
      product: Object,
      index: Number
    },
    data () {
      return {
        show: this.visible,
        newPrice: 0,
        hargaPlain: 0
      }
    },
    computed: {
      amountValue () {
        return this.formatToNumber(this.newPrice)
      }
    },
    methods: {
      ...mapActions([
        'updateOwnProduct'
      ]),
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
      savePrice (event) {
        const btnUpdate = event.target

        const data = {
          price: this.newPrice
        }

        const id = this.product.id
        btnUpdate.classList.add('is-loading')

        this.$http.put(`api/product-vendor/${id}`, data).then(response => {
          const updatedData = {
            index: this.index,
            product: response.data.product
          }
          this.updateOwnProduct(updatedData)
          this.hideAction(null)

          iziToast.success({
            title: 'Sukses',
            message: 'Harga berhasil diperbaharui',
            position: 'bottomRight'
          });
          btnUpdate.classList.remove('is-loading')
        }).catch(err => {
          btnUpdate.classList.remove('is-loading')
        })
      }
    }
  }
</script>
