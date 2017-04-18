<template>
  <nav class="nav-model-classic" :class="{'is-active': onActive }">

    <div class="wrapper-new-nav">

      <div class="logo">

       <a href="http://placehold.it">
        <img src="http://placehold.it/32x32" alt="logo">
       </a>

      </div>

      <div class="icon-wrapper" @click="putar">
        <i class="fa fa-sort-down default-caret" :class="{'caret-is-active': onActive }"></i>
      </div>

    </div>

    <div class="container-menu-touch"
       :class="{'is-active': onActive }">

     <div class="menu-touch" v-if="onActive"
      role="menu">

        <ul class="menu-list">
          <li><a>Dashboard</a></li>
          <li><a>Transaksi</a></li>
          <li><a>Review</a></li>
          <li><a>Favorit</a>
          <li><a>Dompet</a>
          </li>
          <li>
            <hr>
          </li>
          <li><a>Edit Profil</a></li>
          <li><a>Logout</a></li>
        </ul>

      </div>

    </div>

  </nav>
</template>

<script>
  export default {
    data () {
      return {
        onActive: false
      }
    },
    methods: {
      putar () {
        this.onActive = !this.onActive
      }
    }
  }
</script>


<style lang="scss">

</style>
