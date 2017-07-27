<template>
  <div>
    <modalAddUlasan :transaction="activeProduct" v-if="showModal" :show.sync="showModal" />
    <table class="table">
      <thead>
        <tr>
          <td></td>
          <td>Nama Item</td>
          <td>Quantity</td>
          <td>Satuan</td>
          <td>Total</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in transaction">
          <td>{{ index + 1}}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.harga_string }}</td>
          <td>{{ item.total_string }}</td>
          <td>
            <button class="button is-small is-primary" @click="showModalAction(item)">Beri Ulasan</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
  const ModalAddUlasan = () => import('./ModalAddUlasan.vue')
  export default {
    props: ['transaction'],
    components: {
      ModalAddUlasan
    },
    data () {
      return {
        activeProduct: null,
        showModal: false
      }
    },
    methods: {
      showModalAction(item) {
        this.activeProduct = item
        this.showModal = true
      }
    }
  }
</script>
