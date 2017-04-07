<template>
	<div class="masuk">
      
      <section class="section">
        <div class="container">
          <div class="columns is-mobile">
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
  export default {

    components: {
      LoginForm,
      FooterApps
    }
  }
</script>