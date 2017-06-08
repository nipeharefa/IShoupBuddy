<template>
  <div class="ss">
    <router-link :to="{ name: 'formAddProduct' }" append class="button is-primary">Tambah User</router-link>
    <br>
    <table-user></table-user>
  </div>
</template>


<script>
  const TableUser = () => import ('./TableUser.vue')
  export default {
    components: {
      TableUser
    }
  }
</script>
