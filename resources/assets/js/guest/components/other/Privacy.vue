<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>
    <section class="section">
      <div class="container">
        <privacy />
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
  const Privacy = () => import('global/components/Others/Privacy.vue')

  export default {
    components: {
      FooterApps,
      NavbarApps,
      Privacy
    }
  }
</script>
