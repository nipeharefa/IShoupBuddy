<template>
  <div>
    <div>
      <navbar-apps-member></navbar-apps-member>
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column"></div>
        </div>
      </div>
    </section>
    <div id="foo">
        <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  const NavbarAppsMember = () => import('otherComponents/Navbar-Member.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  export default {
    components: {
      NavbarAppsMember,
      FooterApps
    }
  }
</script>
