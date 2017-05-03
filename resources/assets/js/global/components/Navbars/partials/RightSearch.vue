<template>
  <div class="rightnav-guest-search is-hidden-desktop" v-if="searchActive" >
    <div class="search-mobile-wrapper">
      <i class="fa fa-arrow-left" @click="setSearchActive(false)"></i>
      <input type="text" class="control" placeholder="Cari produk..." @keyup.enter="doSearch" v-model="keyword">
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    data () {
      return {
        keyword: ''
      }
    },
    methods: {
      ...mapActions([
        'setSearchActive'
      ]),
      doSearch () {
        window.location.assign(`/search?q=${this.keyword}`)
      }
    },
    computed: {
      ...mapGetters([
        'searchActive'
      ])
    }
  }
</script>
