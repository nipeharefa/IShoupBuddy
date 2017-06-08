<template>
  <div class="ss">
    <router-link :to="{ name: 'formAddProduct' }" append class="button is-primary">Tambah Produk</router-link>
    <br>
    <table-product></table-product>
  </div>
</template>

<script>
  const TableProduct = () => import('./TableProduct.vue')
  export default {
    components: {
      TableProduct
    }
  }
</script>
