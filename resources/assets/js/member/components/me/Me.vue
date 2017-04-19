<template>
	<div>
    <navbar-apps-member></navbar-apps-member>
    <section class="section">
      <div class="container">
        <div class="columns be-body-bro">
          <div class="column is-one-quarter is-hidden-touch">
            <sidebar></sidebar>
          </div>
          <div class="column">
            <summary-profile></summary-profile>
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

	import Sidebar from './Sidebar.vue'
	const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarAppsMember = () => import('otherComponents/Navbar-Member.vue')
  const SummaryProfile = () => import('./SummaryProfile.vue')

	export default {
    data() {
      return {
        onActive: false,
      }
    },
		components: {
			FooterApps,
			Sidebar,
      NavbarAppsMember,
      SummaryProfile
		},
		methods: {
			putar() {
        this.onActive = !this.onActive
			}
		}

	}
</script>
