<template>
	<aside class="menu">
		<!-- <p class="menu-label">
		    General
		</p> -->
		<ul class="menu-list">
		    <li>
          <router-link :to="{ name: 'summaryProfile' }" append>Dashboard</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'formChangePassword' }" append>Tukar Password</router-link>
        </li>

        <li>
          <router-link :to="{ name: 'tableTransaction' }" append>Transaksi</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'tableSaldo' }" append>Saldo</router-link>
        </li>

        <li>
          <router-link :to="{ name: 'productFavorite' }" append>Produk Favorit</router-link>
        </li>

		</ul>

    <p class="menu-label">
      Settings
    </p>

    <ul class="menu-list">
      <li>
        <a @click="logout">Log out</a>
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
          console.log(response)
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>
