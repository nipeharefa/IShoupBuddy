<template>
	<aside class="menu">
		<!-- <p class="menu-label">
		    General
		</p> -->
		<ul class="menu-list">
		    <li>
          <a href="/me">Dashboard</a>
        </li>

        <li>
          <a href="/me/change_password">Tukar Password</a>
        </li>

        <li>
          <a href="/me/transactions">Transaksi</a>
        </li>


        <li>
          <a href="/me/product_favorite">Produk Favorit</a>
        </li>

        <li>
          <a href="" @click="logout">Log out</a>
        </li>

		</ul>

	</aside>
</template>

<script>
  import { mapGetters } from 'vuex'
  export default {
    mounted () {
    },
    data () {
      return {
      }
    },
    compoents: {},
    methods: {
      logout () {
        this.$http.delete('auth/logout').then(response => {
          window.location.assign('/')
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>
