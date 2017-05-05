<template>
  <div>
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
  const NavbarApps = () => import('global/components/Navbars/MemberNavbar.vue')
  const LoginForm = () => import('./LoginForm.vue')

  export default {
    mounted () {},
    components: {
      NavbarApps,
      FooterApps,
      LoginForm
    },
    methods: {}
  }
</script>
