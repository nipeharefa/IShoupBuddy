<template>
    <div>
        <div>
            <navbar-apps-member></navbar-apps-member>
        </div>
        <section class="section">
            <div class="pull-from-fixed">
                <div class="container">
                    <div class="columns">
                        <div class="column is-one-quarter is-hidden-touch">
                          <sidebar></sidebar>
                        </div>
                        <div class="column">
                            <div>
                                <!-- <table-transaction></table-transaction> -->
                            </div>
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
  const Sidebar = () => import('otherComponents/Sidebar-Member')

  export default {
    components: {
        NavbarAppsMember,
        FooterApps,
        Sidebar
    }
  }
</script>
