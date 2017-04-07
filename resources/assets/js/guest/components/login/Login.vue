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

  import LoginForm from 'guest/components/login/LoginForm.vue'
  import FooterApps from 'otherComponents/Footer.vue'
  import NavbarApps from 'otherComponents/Navbar.vue'
  export default {

    components: {
      LoginForm,
      FooterApps,
      NavbarApps
    }
  }
</script>