<template>
  <div>
    <div>
      <navbar-apps-member></navbar-apps-member>
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <div class="pull-from-fixed">
              <form-change-password></form-change-password>
            </div>
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
  const NavbarAppsMember = () => import('otherComponents/Navbar-Member.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const FormChangePassword = () => import('./FormChangePassword')
  export default {
    components: {
      NavbarAppsMember,
      FooterApps,
      FormChangePassword
    }
  }
</script>
