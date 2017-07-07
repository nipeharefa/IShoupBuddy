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
          <input type="text" class="input" v-model="newPrice">
        </div>

        <div class="field">
          <button class="button is-primary is-small" @click="savePrice">Simpan</button>
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
    methods: {
      ...mapActions([
        'updateOwnProduct'
      ]),
      savePrice () {
        const data = {
          price: this.newPrice
        }
        const id = this.product.id
        this.$http.put(`api/product-vendor/${id}`, data).then(response => {
          const updatedData = {
            index: this.index,
            product: response.data.product
          }
          this.updateOwnProduct(updatedData)
          this.hideAction(null)
        }).catch(err => err)
      }
    }
  }
</script>
