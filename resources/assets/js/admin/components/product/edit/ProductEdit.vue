<template>
  <div>
    <formEditProduct v-if="product"/>
  </div>
</template>


<script>
  const FormEditProduct = () => import('./FormEditProduct.vue')
  export default {
    components: {
      FooterApps,
      AdminSidebar,
      FormEditProduct
    }
  }
</script>
