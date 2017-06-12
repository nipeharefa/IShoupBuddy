<template>
  <div>
   <tableCategory />
  </div>
</template>

<script>
  const TableCategory = () => import('./TableCategory.vue')

  export default {
    components: {
      TableCategory
    }
  }
</script>
