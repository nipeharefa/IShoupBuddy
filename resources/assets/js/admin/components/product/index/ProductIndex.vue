<template>
  <div class="ss">
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
        </li>
        <li class="is-active"><a>Produk</a></li>
      </ul>
    </nav>
    <router-link :to="{ name: 'formAddProduct' }" append class="button is-small is-primary">Tambah Produk</router-link>
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
