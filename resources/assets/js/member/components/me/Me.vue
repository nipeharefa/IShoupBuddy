<template>
	<div>
		<section class="section">
			<div class="container">
				<div class="columns is-one-quarter">
					<sidebar></sidebar>
					<!-- Oke Bos -->
				</div>
			</div>
		</section>
		<footer-apps></footer-apps>
	</div>
</template>

<style>
	.help {
		color: white;
	}
</style>
<script>

	import Sidebar from './Sidebar.vue'
	import FooterApps from 'otherComponents/Footer.vue'



	export default {
		mounted() {

      const self = this

      this.$http.get('/api/user')
        .then( x => {
          console.log(x)
        }).catch( x => {
          console.log(x)
        })
		},
    
		components: {
			FooterApps,
			Sidebar
		}

	}
</script>