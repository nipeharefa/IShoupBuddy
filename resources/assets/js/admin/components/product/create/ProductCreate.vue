<template>
  <div class="nipeharefa">
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
        </li>
        <li>
           <router-link :to="{ name: 'listProduct' }" append>
            Produk
          </router-link>
        </li>
        <li class="is-active"><a>Tambah Produk</a></li>
      </ul>
    </nav>
    <formAddProduct />
  </div>
</template>

<script>
  const FormAddProduct = () => import('adminProduct/create/FormAddProduct.vue')

  export default {
    components: {
      FormAddProduct
    }
  }
</script>
