<template>
  <div>
    <formAddCategory />
  </div>
</template>

<script>
  const FormAddCategory = () => import('./FormAddCategory.vue')
  export default {
    components: {
      FormAddCategory
    }
  }
</script>
