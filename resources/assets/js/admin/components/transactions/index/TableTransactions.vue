<template>
  <table class="table">
    <thead>
      <tr>
        <th>ID Transaksi</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in transactions">
      </tr>
    </tbody>
  </table>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    props: ['role'],
    computed: {
      ...mapGetters([])
    }
  }
</script>
