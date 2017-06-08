<template>
  <div class="ss">
    <a href="/admin/product/create" class="button is-primary">Tambah Produk</a>
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
