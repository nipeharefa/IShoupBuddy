<template>
  <div class="column">
    <div class="total-cart">
      <span class="title is-4 cart-total">
        {{ test() }}
        <span>{{ belanja.total_string }}</span>
      </span>
      <span class="cart-lbl">Total Belanja</span>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    data () {
      return {
        belanja: {
          total_string: "Rp. 0"
        }
      }
    },
    computed: {
      ...mapGetters(['carts', 'cartChecked']),
      async totalBelanja() {
        return await this.$http.post('api/cart/getSubTotal', {arrayIds: this.cartChecked});
      }
    },
    methods: {
      test() {
        this.totalBelanja.then(response => {
          this.belanja = response.data
        })
      }
    }
  }
</script>
