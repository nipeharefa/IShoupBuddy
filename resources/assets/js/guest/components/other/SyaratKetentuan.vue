<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>
    <section class="section">
      <div class="container">
        <syaratKetentuan />
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
  const SyaratKetentuan = () => import('global/components/Others/SyaratKetentuan.vue')

  export default {
    components: {
      FooterApps,
      NavbarApps,
      SyaratKetentuan
    }
  }
</script>
