<template>
  <div class="dazzle">
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
