<template>
  <div class="nipeharefa">
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
