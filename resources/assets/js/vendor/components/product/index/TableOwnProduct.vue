<template>
  <div>

    <table class="table">
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
          <td>{{ item.total_review || 0 }} / {{ item.avg_rating || 0 }}</td>
          <td>{{ item.price_string }}</td>
          <td>
            <a class="button is-small" @click="showModal(item, index)">Update Harga</a>
          </td>
        </tr>
      </tbody>
    </table>

    <modalUpdatePrice v-if="activeModals"
    :hideAction="showModal"
    :index="index"
    :product="activeProduct"/>

  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  import ModalUpdatePrice from 'global/components/Product/ModalUpdatePrice.vue'
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
        index: null
      }
    },
    components: {
      ModalUpdatePrice
    },
    methods: {
      showModal (item, index) {
        this.activeProduct = item
        this.index = index
        this.activeModals = !this.activeModals
      }
    }
  }
</script>
