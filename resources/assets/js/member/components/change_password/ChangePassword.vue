<template>
  <div>
    <div>
      <navbar-apps-member></navbar-apps-member>
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-one-quarter is-hidden-touch aside-v1">
            <sidebar class="pull-from-fixed "></sidebar>
          </div>
          <div class="column is-half-desktop is-offset-1-desktop pull-from-fixed">
              <form-change-password></form-change-password>
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
  const NavbarAppsMember = () => import('global/components/Navbars/MemberNavbar.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const FormChangePassword = () => import('./FormChangePassword')
  const Sidebar = () => import('otherComponents/Sidebar-Member.vue')
  export default {
    components: {
      NavbarAppsMember,
      FooterApps,
      FormChangePassword,
      Sidebar
    }
  }
</script>
