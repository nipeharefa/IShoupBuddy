<template>
	<div class="masuk">
     
     <div>
       
       <navbar-apps></navbar-apps>

     </div> 
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-5 is-offset-one-quarter">
              <login-form></login-form>
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

  
  // const LoginForm = import('./LoginForm.vue')
  // import FooterApps from 'otherComponents/Footer.vue'
  // import NavbarApps from 'otherComponents/Navbar.vue'

  export default {

    components: {
      LoginForm: () => import('./LoginForm.vue'),
      FooterApps: () => import('otherComponents/Footer.vue'),
      NavbarApps: () => import('otherComponents/Navbar.vue')
    }
  }
</script>