<template>
	<div>
    <navbar-apps-member></navbar-apps-member>
    <section class="section">
      <div class="container">
        <div class="columns be-body-bro">
          <div class="column">
            <div>
              <div>
                <div class="profile-wrapper">
                  <div class="image-photo">
                    <img src="http://placehold.it/64x64" alt="profile Logo">
                  </div>
                  <div>
                    <p>Nipe Setiawan Harefa</p>
                    <small>nipeharefa@gmail.com</small>
                  </div>
                </div>
                <div class="profil-phone-box">
                  <h1>Phone : </h1>
                  <small>
                    +6282275121178
                  </small>
                </div>
                <div class="profil-address-box">
                  <h1>Alamat : </h1>
                  <small>Jalan Diponegoro No. 777 Kecamatan Medan Kota, Medan - Indonesia</small>
                </div>
                <div>
                  <a href="/me/edit" class="button is-primary is-small">Edit Profil</a>
                </div>
              </div>
              <div></div>
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

	import Sidebar from './Sidebar.vue'
	const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarAppsMember = () => import('otherComponents/Navbar-Member.vue')

	export default {
    data() {
      return {
        onActive: false,
      }
    },
		components: {
			FooterApps,
			Sidebar,
      NavbarAppsMember
		},
		methods: {
			putar() {
        this.onActive = !this.onActive
			}
		}

	}
</script>
