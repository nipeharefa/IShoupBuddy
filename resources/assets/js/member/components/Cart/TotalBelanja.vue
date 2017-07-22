<template>
  <div class="column">
    <div class="total-cart">
      <span class="title is-4 cart-total">{{ cartsTotalString }}</span>
      <span class="cart-lbl">Total Belanja</span>
    </div>
  </div>
</template>


<script>
  export default {
    props: {
      cartsTotalString: {
        required: true
      }
    }
  }
</script>
