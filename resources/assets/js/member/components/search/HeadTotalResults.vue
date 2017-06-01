<template>
  <div class="total_search_results">
    <small>Total Pencarian {{ total }} dari kata kunci <b>{{ keyword }}</b></small>
  </div>
</template>

<script>
  export default {
    props: [
      'total'
    ],
    data () {
      return {
        keyword: window.katakunci
      }
    }
  }
</script>

<style lang="scss">
  .total_search_results {
    text-align: center;
  }
</style>
