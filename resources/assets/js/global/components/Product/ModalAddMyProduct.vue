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
            <input class="input" type="text" placeholder="Harga"  v-model="newPrice">
          </p>
        </div>

        <div class="field">
          <button class="button is-primary" @click="savePrice">Simpan</button>
        </div>

      </div>
    </div>
    <button class="modal-close" @click="hideAction(false)"></button>
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
  export default {
    props: {
      hideAction: {
        type: Function,
        required: true
      },
      price: {
        default: 0
      },
      data: Object,
      addData: Function,
      addedProduct: Function
    },
    data () {
      return {
        dataForm: this.data,
        newPrice: this.price
      }
    },
    methods: {
      savePrice () {
        const data = {
          productID: this.dataForm.id,
          price: this.newPrice
        }
        this.$http.post('api/product-vendor', data).then(response => {
          this.addedProduct(response.data.product)
        }).catch(err => err)
      }
    }
  }
</script>
