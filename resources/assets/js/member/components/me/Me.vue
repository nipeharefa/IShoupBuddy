<template>
	<div>
		<footer-apps></footer-apps>
	</div>
</template>

<style>
	.help {
		color: white;
	}
</style>
<script>
	// 
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
			FooterApps
		}

	}
</script>