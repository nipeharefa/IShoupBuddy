<template>
  <div class="total_search_results">
    <small v-if="keyword">
      Total Pencarian {{ total }} dengan kata kunci <b>{{ keyword }}</b>,  dengan kategory <b>{{ category_string }}</b>
    </small>
    <small v-if="!keyword">
      Total Pencarian {{ total }} dengan kategory <b>{{ category_string }}</b>
    </small>
  </div>
</template>

<script>
  export default {
    created () {
      this.keyword = window.katakunci
      this.category_string = window.category_string
    },
    props: [
      'total'
    ],
    data () {
      return {
        keyword: null,
        category_string: "Semua Kategori"
      }
    }
  }
</script>

<style lang="scss">
  .total_search_results {
    text-align: center;
  }
</style>
