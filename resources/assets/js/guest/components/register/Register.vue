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

	const FooterApps = () => import('otherComponents/Footer.vue')
	const NavbarApps = () => import('otherComponents/Navbar.vue')
	const TabsForm  = () => import('./TabsForm.vue')

	export default {

		components: {
			FooterApps,
			TabsForm,
			NavbarApps
		}
	}
</script>