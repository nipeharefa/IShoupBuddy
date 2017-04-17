<template>
	<div>
    <div>
      <nav class="nav-model-classic">
      <div class="wrapper-new-nav">
        <div class="logo">
         <a href="http://placehold.it">
          <img src="http://placehold.it/32x32" alt="logo">
         </a> 
        </div>
        <div class="icon-wrapper" @click="putar">
          <i class="fa fa-sort-down default-caret" :class="{'caret-is-active': onActive }"></i>
        </div>
      </div>
      <transition name="slide-fade">
        <div class="content-naik" v-if="onActive" role="menu">
          <div class="bungkus-nasi">
            <ul class="menu-list">
                <li><a>Dashboard</a></li>
                <li><a>Transaksi</a></li>
                <li><a>Review</a></li>
                <li><a>Favorit</a>
                </li>
                <li>
                  <hr>
                </li>
                <li><a>Edit Profil</a></li>
                <li><a>Logout</a></li>
            </ul>
          </div>
        </div>
      </transition>
    </nav>
    </div>
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
                  <button class="button is-primary">Edit Profil</button>
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



	export default {
    data() {
      return {
        onActive: false,
      }
    },
		components: {
			FooterApps,
			Sidebar
		},
		methods: {
			putar() {
        this.onActive = !this.onActive
			}
		}

	}
</script>