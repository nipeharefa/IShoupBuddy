<template>
  <div>
    <div>
      <navbarApps></navbarApps>
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
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar.vue')
  const LoginForm = () => import('./LoginForm.vue')

  export default {
    components: {
      NavbarApps,
      FooterApps,
      LoginForm
    },
    methods: {}
  }
</script>
