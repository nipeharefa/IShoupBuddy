<template>
  <div>
    <div class="user-profile">
      <div class="user-detail-profile">
        <div class="user-fullname">
          <small>Nama Lengkap</small>
          <span>{{ activeUser.name }}</span>
        </div>
        <div class="user-email">
          <small>Nama Lengkap</small>
          <span>{{ activeUser.email }}</span>
        </div>
        <div class="user-phone">
          <small>Nomor Handphone</small>
          <span>{{ activeUser.phone }}</span>
        </div>
        <div class="user-address">
          <small>Alamat</small>
          <span>{{ activeUser.address}}</span>
        </div>
        <div>
          <!-- <a href="/me/edit" class="button is-primary is-small">Edit Profil</a> -->
          <router-link :to="{ name: 'formEditProfile' }"
            class="button is-primary is-small" append>Edit Profil</router-link>
        </div>

      </div>
      <div class="user-profile-picture">
        <div class="image is-128x128 is-square image-photo">
          <img :src="activeUser.picture_links.small" alt="profile Logo">
        </div>
      </div>
    </div>

    <div class="panel-links is-hidden-desktop">
      <div class="link-item">
        <i class="fa fa-key" aria-hidden="true"></i>
        <span>Ganti Password</span>
      </div>
      <div class="link-item">
        <i class="fa fa-heart" aria-hidden="true"></i>
        <span>Produk Favorit</span>
      </div>
      <div class="link-item">
        <i class="fa fa-exchange" aria-hidden="true"></i>
        <span>Transaksi</span>
      </div>
      <div class="link-item">
        <i class="fa fa-star" aria-hidden="true"></i>
        <span>Review</span>
      </div>
    </div>
    <div class="panel-container">
      <div class="panel-info">
        <div class="panel-header">
          <span>Shoup Kantong</span>
        </div>
        <div class="panel-content">
          <ul class="list">
            <li>
              Total Saldo
              <a href="">Rp. 100.000</a>
            </li>
            <li>
              History
              <a href="">0</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="panel-info">
        <div class="panel-header">
          <span>Transaksi</span>
        </div>
        <div class="panel-content">
          <ul class="list">
            <li>
              Sukses
              <a href="">1</a>
            </li>
            <li>
              Pending
              <a href="">1</a>
            </li>
            <li>
              Gagal
              <a href="">0</a>
            </li>
          </ul>
        </div>
      </div>

          <div class="panel-info">
            <div class="panel-header">
              <span>Product</span>
            </div>
            <div class="panel-content">
              <ul class="list">
                <li>
                  Produk Favorite
                  <a href="">1</a>
                </li>
                <li>
                  Review
                  <a href="">0</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters([
        'activeUser'
      ])
    }
  }
</script>
