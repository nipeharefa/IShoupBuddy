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

  export default {

    components: {
      LoginForm: () => import('./LoginForm.vue'),
      FooterApps: () => import('otherComponents/Footer.vue'),
      NavbarApps: () => import('global/components/Navbars/GuestNavbar')
    }
  }
</script>
