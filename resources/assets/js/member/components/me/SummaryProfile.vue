<template>
  <div>
    <nav class="breadcrumb breadwrapper">
      <ul>
        <li><a>Halaman Depan</a></li>
        <li class="is-active"><a>{{ activeUser.name }}</a></li>
      </ul>
    </nav>

    <div class="summary-profile">
      <h5 class="subtitle is-5">Profile</h5>
      <router-link :to="{ name: 'formEditProfile' }"
            class="button is-primary is-small" append>Edit Profil</router-link>
    </div>
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

      </div>
      <div class="user-profile-picture">
        <div class="image is-128x128 is-square image-photo">
          <img :src="activeUser.picture_links.small" alt="profile Logo">
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .image-photo {
    img {
      object-fit: scale-down !important;
    }
  }
</style>

<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters([
        'activeUser',
        'wishlists'
      ])
    }
  }
</script>
