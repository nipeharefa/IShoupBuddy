<template>
  <nav class="breadcrumb">
    <ul>
      <li><a href="/">Halaman Depan</a></li>
      <li>
        <a href="/">Kategory</a>
      </li>
      <li class="is-active"><a>{{ category.name }}</a></li>
    </ul>
  </nav>
</template>


<script>
  export default {
    created () {
      this.category = window._sharedData.category
    },
    data () {
      return {
        category: null
      }
    }
  }
</script>
