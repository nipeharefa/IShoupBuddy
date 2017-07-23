<template>
  <nav class="panel">
    <p class="panel-heading">
      <label class="checkbox">
        <input type="checkbox" v-model="checked" :value="cart.id" @change="eventCheckedChanges">
        <i class="fa fa-building"></i>
        <span>{{ cart.vendor.name }}</span>
      </label>
    </p>
    <panelDetail :cartItem="cart.item" :cartIndex="cartIndex" />
  </nav>
</template>


<script>
  const PanelDetail = () => import('./PanelDetail.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    props: {
      cart: {
        required: true
      },
      cartIndex: {
        required: true
      }
    },
    components: {
      PanelDetail
    },
    data () {
      return {
        checked: []
      }
    },
    computed: {
      ...mapGetters(['cartChecked'])
    },
    methods: {
      ...mapActions(['updateCartChecked']),
      eventCheckedChanges () {
        this.updateCartChecked(this.checked)
      }
    }
  }
</script>
