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
        <tr v-for="(item, index) in products">
          <td>{{ item.name }}</td>
          <td>{{ item.barcode }}</td>
          <td>{{ item.total_review || 0 }} Reviewer / {{ item.avg_rating || 0 }}
            <svg data-v-34cbeed1="" height="15" width="15" step="100" style="overflow: visible;"><linearGradient id="7uuevc" x1="0" x2="100%" y1="0" y2="0"><stop offset="100%" stop-color="#f7d120"></stop> <stop offset="100%" stop-color="#d8d8d8"></stop></linearGradient> <polygon points="6.906976744186047,0.7674418604651163,2.302325581395349,15.195348837209304,13.813953488372094,5.986046511627907,0,5.986046511627907,11.511627906976745,15.195348837209304" fill="url(#7uuevc)" stroke="#999" stroke-width="0"></polygon> <polygon points="6.906976744186047,0.7674418604651163,2.302325581395349,15.195348837209304,13.813953488372094,5.986046511627907,0,5.986046511627907,11.511627906976745,15.195348837209304" fill="url(#7uuevc)"></polygon></svg>
          </td>
          <td>{{ item.vendors.length }}</td>
          <td>
            <a class="button is-small" title="Add to My Product" :disabled="item.used" @click="showModalAddToMyProduct(item, index)">
              <i class="fa fa-plus"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <modalAddProduct v-if="modalShow"
      :data="activeData"
      :modalShow.sync="modalShow"
      :indexActive="indexActive"
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
        activeData: {},
        indexActive: null
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
      showModalAddToMyProduct (item, index, e) {
        if (item.used) {
          return
        }
        this.activeData = item || {}
        this.indexActive = index
        this.modalShow = !this.modalShow
      },
      addYoMyProduct ( item ) {
      },
      addedProduct () {}
    }
  }
</script>
