<template>
  <div>
    <div>
      <div class="profile-wrapper">
        <div class="image-photo">
          <img :src="activeUser.picture_links.small" alt="profile Logo">
        </div>
        <div>
          <p>{{ activeUser.name }}</p>
          <small>{{ activeUser.email }}</small>
        </div>
      </div>
      <div class="profil-phone-box">
        <h1>Phone : </h1>
        <small>
        {{ activeUser.phone }}
        </small>
      </div>
      <div class="profil-address-box">
        <h1>Alamat : </h1>
        <small>{{ activeUser.address }}</small>
      </div>
      <div>
        <a href="/me/edit" class="button is-primary is-small">Edit Profil</a>
      </div>
    </div>
    <div></div>
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
