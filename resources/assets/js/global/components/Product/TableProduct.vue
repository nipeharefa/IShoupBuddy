<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Nama Produk</th>
          <th>Barcode</th>
          <th>Harga</th>
          <th>Last Updated</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in products">
          <td>{{ key+1 }}</td>
          <td>
            <div>
              {{ item.name }}
            </div>
            <div class="controls" id="vendor_controls" v-if="isVendor">
              <a @click="showModalAddToMyProduct(item)">
                <i class="fa fa-pencil"></i>
              </a>
              <a>
                <i class="fa fa-eye" :class="{'fa-eye-slash': item.inTrash }" @click="deleteProductVendor(item)"></i>
              </a>
            </div>
          </td>
          <td>{{ item.barcode }}</td>
          <td>Rp. {{ item.minimum_price }}</td>
          <td>29 Januari 2012</td>
          <td>
            <a href="" @click="hideProduct" v-if="hideAction">Hide</a>
            <a href="" @click="hideProduct" v-if="deleteAction">Detele</a>
            <a class="is-link" @click="showModalAddToMyProduct(item)" v-if="addMyProductAction">Add to My Product</a>
          </td>
        </tr>
      </tbody>
    </table>
    <modalAddProduct v-if="modalShow"
      :hideAction="showModalAddToMyProduct"
      :data="activeData"
      :addedProduct="addedProduct"></modalAddProduct>
  </div>
</template>

<style lang="scss" scoped>
  .fa {
    font-size: 1rem;
  }
</style>


<script>

  const ModalAddProduct = () => import('global/components/Product/ModalAddMyProduct')

  export default {
    props: {
      addMyProductAction: {
        type: Boolean,
        default: false
      },
      addedProduct: Function,
      delete: {
        type: Boolean,
        default: false
      },
      deleteAction: {
        type: Boolean,
        default: false
      },
      hideAction: {
        type: Boolean,
        default: false
      },
      isVendor: {
        type: Boolean,
        default: false
      },
      products: Array,
      productsKey: {
        type: String,
        default: 'products'
      }
    },
    mounted() {

    },
    data () {
      return {
        modalShow: false,
        activeData: {}
      }
    },
    components: {
      ModalAddProduct
    },
    methods: {
      hideProduct () {
        console.log('action hide')
      },
      showModalAddToMyProduct (item, e) {
        this.activeData = item || {}
        this.modalShow = !this.modalShow
      },
      _addToMyProduct (item) {
        const data = {
          productId: item.id
        }
        this.$http.post('api/product-vendor', data).then(response => {
          const product = response.data.product
        }).catch(err => err)
      },
      deleteProductVendor (item) {
        const data = item

        if (data.inTrash) {
          this.$http.post(`api/product-vendor/restore/${data.product_vendor_id}`).then(response => {
            const product = response.data.product
          }).catch(err => err)
        } else {
          this.$http.delete(`api/product-vendor/${data.product_vendor_id}`).then(response => {
            const product = response.data.product
          }).catch(err => err)
        }

        return
      }
    }
  }
</script>
