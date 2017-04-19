<template>
  <div>
    <div>
      <navbar-apps-member></navbar-apps-member>
    </div>
    <section class="section">

      <div class="pull-from-fixed-5">

        <div class="container">

          <div class="columns">

            <div class="column is-one-quarter is-hidden-touch">
              <sidebar></sidebar>
            </div>

            <div class="column">

              <detail-transaction></detail-transaction>

            </div>

          </div>

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
  const DetailTransaction = () => import('./DetailTransaction.vue')
  const Sidebar = () => import('otherComponents/Sidebar-Member')

  export default {
    components: {
      NavbarAppsMember,
      DetailTransaction,
      FooterApps,
      Sidebar
    }
  }
</script>
