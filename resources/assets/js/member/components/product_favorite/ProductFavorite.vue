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
                            <div class="modeview">
                                <!-- <table-transaction></table-transaction> -->
                                <small>Model Tampilan</small>
                                <i class="fa fa-bars" title=""></i>
                                <i class="fa fa-th" title=""></i>
                            </div>
                            <div class="wrapping">
                              <div class="nusa" v-for="item in 16">
                                <a href="/product/1">
                                  <product-card></product-card>
                                </a>
                              </div>
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
  const ProductCard = () => import('otherComponents/ProductCard.vue')

  export default {
    components: {
        NavbarAppsMember,
        FooterApps,
        Sidebar,
        ProductCard
    }
  }
</script>
