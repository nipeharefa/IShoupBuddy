<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Barcode</th>
          <th>Rating</th>
          <th>Total Vendor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in products">
          <td>{{ item.name }}</td>
          <td>{{ item.barcode }}</td>
          <td>{{ item.total_review || 0}} / {{ item.avg_rating || 0 }}</td>
          <td>{{ item.vendors.length }}</td>
          <td>
            <a class="button is-small" title="Add to My Product" :disabled="item.used" @click="showModalAddToMyProduct(item)">
              <i class="fa fa-plus"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <modalAddProduct v-if="modalShow"
      :data="activeData"
      :modalShow.sync="modalShow"
      :addedProduct="addedProduct"></modalAddProduct>

  </div>
</template>

<style lang="scss">
  @import "node_modules/izitoast/dist/css/iziToast.min";
</style>

<script>
  import { mapGetters } from 'vuex'
  import izitoast from 'izitoast'
  const ModalAddProduct = () => import('global/components/Product/ModalAddMyProduct')
  export default {
    props: ['role'],
    data () {
      return {
        modalShow: false,
        activeData: {}
      }
    },
    components: {
      ModalAddProduct
    },
    computed: {
      ...mapGetters([
        'products'
      ])
    },
    methods: {
      showModalAddToMyProduct (item, e) {
        if (item.used) {
          return
        }
        this.activeData = item || {}
        this.modalShow = !this.modalShow
      },
      addYoMyProduct ( item ) {
      },
      addedProduct () {

      }
    }
  }
</script>
