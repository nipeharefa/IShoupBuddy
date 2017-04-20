<template>
  <div>
    <div class="nav">
      <div class="container">

        <div class="nav-left">

            <a class="nav-item">
                <h1>IshoupBuddy</h1>
            </a>
          </div>

        <span class="nav-toggle" :class="{'is-active': openedNav }" @click="openNav">
            <span></span>
            <span></span>
            <span></span>
          </span>

          <div class="nav-right nav-menu" :class="{'is-active': openedNav }">
              <a class="nav-item is-tab" href="/register">Register</a>
              <a class="nav-item is-tab" href="/login">Login</a>
          </div>

      </div>


    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        openedNav: false
      }
    },
    methods: {
      openNav() {
        this.openedNav = !this.openedNav
      }
    }
  }
</script>
