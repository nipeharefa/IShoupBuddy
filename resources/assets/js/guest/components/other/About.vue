<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>
    <section class="section">
      <div class="container">
        <about />
      </div>
    </section>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const About = () => import('global/components/Others/About.vue')

  export default {
    components: {
      FooterApps,
      NavbarApps,
      About
    }
  }
</script>
