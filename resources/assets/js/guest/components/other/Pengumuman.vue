<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>
    <section class="section">
      <div class="container">
        <pengumuman />
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
  const Pengumuman = () => import('global/components/Others/Pengumuman.vue')

  export default {
    components: {
      FooterApps,
      NavbarApps,
      Pengumuman
    }
  }
</script>
