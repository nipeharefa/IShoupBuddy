<template>
  <div>
     <router-link :to="{ name: 'formAddCategory' }"
     append class="button is-primary is-small">Tambah Kategori
     </router-link>

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
