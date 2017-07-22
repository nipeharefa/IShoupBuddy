<template>
  <nav class="panel">
    <p class="panel-heading">
      <label class="checkbox">
        <input type="checkbox">
        <i class="fa fa-building"></i>
        <span>{{ cart.vendor.name }}</span>
      </label>
    </p>
    <panelDetail :cartItem="cart.item" :cartIndex="cartIndex" />
  </nav>
</template>


<script>
  const PanelDetail = () => import('./PanelDetail.vue')

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
    }
  }
</script>
