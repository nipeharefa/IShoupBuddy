<template>
  <div class="nav-right nav-menu">
      <a class="nav-item is-tab" href="/cart">
        <i class="fa fa-shopping-cart white cart-icon-wrapper" aria-hidden="true">
          <div class="cart-counter">
            <span>{{ totalCart }}</span>
          </div>
        </i>
      </a>
      <div class="user_info">
        <a class="nav-item" href="/me">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span class="user_name">Hi, {{activeUser.name}}</span>
        </a>
      </div>
  </div>
</template>

<style lang="scss" scoped>
  // .punya {
  //   .dropdown {
  //     position: absolute;
  //     background: #8c3737;
  //     z-index: 102;
  //     bottom: -35px;
  //     direction: rtl;
  //     padding: 14px;
  //     margin-left: 12px;
  //     display: none;
  //   }
  //   &:hover {
  //     .dropdown {
  //       display: block !important;
  //     }
  //   }
  // }
  .cart-icon-wrapper {
    position: relative;
    .cart-counter {
      position: absolute;
      font-size: 0.8rem;
      right: -6px;
      top: -5px;
      z-index: 100;
      color: black;
      background-color: #ffc53e;
      padding: 2px;
      border-radius: 10px;
    }
  }
  span.user_name {
    font-size: 0.8rem;
    margin-left: 0.4rem;
  }
</style>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'activeUser',
        'totalCart'
      ]),
      guest () {
        return this.activeUser === null
      }
    }
  }
</script>
