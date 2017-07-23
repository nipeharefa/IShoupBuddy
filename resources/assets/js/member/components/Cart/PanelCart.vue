<template>
  <nav class="panel">
    <p class="panel-heading">
      <label class="checkbox">
        <input type="checkbox" :value="cart.id" @change="eventCheckedChanges(cart.id)">
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
    computed: {
      ...mapGetters(['cartChecked'])
    },
    data () {
      return {
        checked: []
      }
    },
    methods: {
      ...mapActions(['updateCartChecked']),
      eventCheckedChanges (id) {
        console.log(this.cartChecked)
        const c = this.cartChecked.findIndex( x => {
          return x === id
        })

        console.log(id)
        const a = this.cartChecked.push(id)
        // this.updateCartChecked(a)\
        console.log(a)
        return
      }
    }
  }
</script>
