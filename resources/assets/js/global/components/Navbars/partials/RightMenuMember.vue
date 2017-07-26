<template>
  <div class="navbar-end">

    <a class="navbar-item no-hover-change" href="/me/saldo" title="Saldo">
      <span class="icon" style="color: #fff;">
        <i class="fa fa-money"></i>
      </span>
    </a>

    <a class="navbar-item no-hover-change" href="/cart" title="Keranjang Belanja">
      <span class="icon" style="color: #fff;">
        <i class="fa fa-shopping-cart"></i>
      </span>
    </a>
    <a class="navbar-item no-hover-change" href="/me/transaction" title="Transaksi">
      <span class="icon" style="color: #fff;">
        <i class="fa fa-exchange"></i>
      </span>
    </a>

    <div class="navbar-item has-dropdown is-hoverable ">
      <a class="navbar-link no-hover-change" href="/me">
        <span class="navbar-user-fullname">
          Hi, {{ activeUser.name }}
        </span>
      </a>

      <div class="navbar-dropdown dropdown-right">
        <a class="navbar-item " href="/me/edit">
          Edit Profil
        </a>
        <a class="navbar-item " href="/me/wishlist">
          Produk Favorit
        </a>
        <hr class="navbar-divider">
        <a class="navbar-item " href="#" @click="logout">
          Logout
        </a>
      </div>
    </div>

  </div>
</template>


<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'activeUser'
      ])
    },
    methods: {
      logout () {
        console.log('logout')
        this.$http.delete('auth/logout').then(response => {
          window.location.assign('/')
          console.log(response)
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>
