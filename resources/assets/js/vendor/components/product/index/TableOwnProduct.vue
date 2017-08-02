<template>
  <div>
    <table class="table is-narrow">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Barcode</th>
          <th>Rating</th>
          <th>Harga</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in ownProducts">
          <td>{{ item.name }}</td>
          <td>{{ item.barcode }}</td>
          <td>{{ item.total_review || 0 }} Reviewer / {{ item.avg_rating || 0 }}
             <svg data-v-34cbeed1="" height="15" width="15" step="100" style="overflow: visible;"><linearGradient id="7uuevc" x1="0" x2="100%" y1="0" y2="0"><stop offset="100%" stop-color="#f7d120"></stop> <stop offset="100%" stop-color="#d8d8d8"></stop></linearGradient> <polygon points="6.906976744186047,0.7674418604651163,2.302325581395349,15.195348837209304,13.813953488372094,5.986046511627907,0,5.986046511627907,11.511627906976745,15.195348837209304" fill="url(#7uuevc)" stroke="#999" stroke-width="0"></polygon> <polygon points="6.906976744186047,0.7674418604651163,2.302325581395349,15.195348837209304,13.813953488372094,5.986046511627907,0,5.986046511627907,11.511627906976745,15.195348837209304" fill="url(#7uuevc)"></polygon></svg>
          </td>
          <td>{{ item.price_string }}</td>
          <td>
            <a class="button is-small" @click="showModal(item, index)">Update Harga</a>
            <a class="button is-small" @click="showModalTransaction(item, index)">Statistic</a>
          </td>
        </tr>
      </tbody>
    </table>

    <modalUpdatePrice v-if="activeModals"
    :hideAction="showModal"
    :index="index"
    :product="activeProduct"/>

    <modalTransaction v-if="onShowStatistic" :index="index"
    :product="activeProduct" :show.sync="onShowStatistic" />
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  import ModalUpdatePrice from 'global/components/Product/ModalUpdatePrice.vue'
  const ModalTransaction = () => import('./ModalTransaction.vue')
  export default {
    props: ['role'],
    computed: {
      ...mapGetters([
        'ownProducts'
      ])
    },
    data () {
      return {
        activeModals: false,
        activeProduct: null,
        index: null,
        onShowStatistic: false,
      }
    },
    components: {
      ModalUpdatePrice,
      ModalTransaction
    },
    methods: {
      showModal (item, index) {
        this.activeProduct = item
        this.index = index
        this.activeModals = !this.activeModals
      },
      showModalTransaction(item, index) {
        this.activeProduct = item
        this.index = index
        this.onShowStatistic = !this.onShowStatistic
      }
    }
  }
</script>
