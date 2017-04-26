<template>
  <div>
    <div class="nav">
      <div class="container">

        <div class="nav-left">
          <a href="/" class="nav-item">
            <h1>ISHOUPBUDDY LOGO11</h1>
          </a>
        </div>

        <div class="nav-center is-hidden-touch">
          <a class="nav-item">
            <div class="field has-addons">
              <p class="control akumaubelanja">
                <input class="input" type="text" placeholder="Aku mau cari.." role="search">
              </p>
              <p class="control">
                <a class="button">
                  <i class="fa fa-search"></i>
                </a>
              </p>
            </div>
          </a>
        </div>

        <span class="nav-toggle" :class="{'is-active': openedNav }" @click="openNav">
            <span></span>
            <span></span>
            <span></span>
          </span>

          <div class="nav-right nav-menu" :class="{'is-active': openedNav }">
              <a class="nav-item is-tab" href="/cart">
                <i class="fa fa-shopping-cart"></i>
              </a>
              <a class="nav-item is-tab" href="/login">Login</a>
              <a class="nav-item is-tab" href="/register">
                <button class="button">Register</button>
              </a>
          </div>

      </div>


    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        openedNav: false
      }
    },
    methods: {
      openNav () {
        this.openedNav = !this.openedNav
      }
    }
  }
</script>
