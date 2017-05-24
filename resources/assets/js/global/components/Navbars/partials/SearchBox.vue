<template>
  <div class="nav-center is-hidden-touch">
    <a class="nav-item">
      <div class="field has-addons">
        <p class="control akumaubelanja">
          <input class="input" type="text" placeholder="Cari produk" role="search" v-model="q"
            @keyup.enter="search">
        </p>
        <p class="control">
          <a class="button" @click="search">
            <i class="fa fa-search"></i>
          </a>
        </p>
      </div>
    </a>
  </div>
</template>


<script>
  export default {
    data () {
      return {
        q: ''
      }
    },
    methods: {
      search () {
        window.location.assign(`/search?q=${this.q}`)
      }
    }
  }
</script>
