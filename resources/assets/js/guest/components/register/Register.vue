<template>
	<div>

		<div>
       
       		<navbar-apps></navbar-apps>

	     </div> 
		<section class="section">
			
			<div class="container">
				<div class="column is-5 is-offset-one-quarter">
              		<tabs-form></tabs-form>

              		<div class="to-login">
              			<p>Sudah Punya Akun ?</p>
              			<a href="/login">Login</a>
              		</div>
            	</div>
			</div>	
		</section>

		<!-- Footer -->
      <div>
        <footer-apps></footer-apps>
      </div>

	</div>
</template>


<script>
	import FooterApps from 'otherComponents/Footer.vue'
	import NavbarApps from 'otherComponents/Navbar.vue'

	import TabsForm from './TabsForm.vue'

	export default {

		components: {
			FooterApps,
			TabsForm,
			NavbarApps
		}
	}
</script>