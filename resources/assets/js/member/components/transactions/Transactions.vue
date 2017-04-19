<template>
    <div>
        <div>
            <navbar-apps-member></navbar-apps-member>
        </div>
        <section class="section">
            <div class="pull-from-fixed">
                <div class="container">
                    <div class="columns">
                        <div class="column">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis laudantium nam alias, aspernatur odit esse, labore optio consequatur earum consequuntur eum. Sit, fugiat, nobis! Consequatur facilis omnis dicta, eos itaque!</p>
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

  export default {
    components: {
        NavbarAppsMember,
        FooterApps
    }
  }
</script>
