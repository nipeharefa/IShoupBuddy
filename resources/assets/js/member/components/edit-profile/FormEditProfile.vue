<template>
  <div class="form-edit-profile-wrapper">
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li class="is-active"><a>Edit Profil</a></li>
      </ul>
    </nav>
    <div class="columns">
      <div class="column is-half">

        <div class="field">
          <label class="label">Name</label>
          <p class="control">
            <input class="input" type="text" placeholder="Alex Fergusen" v-model="user.name" v-validate="'required'" name="user_name" :class="{'is-danger': errors.has('user_name') }" >
          </p>
          <p class="help is-danger" v-show="errors.has('user_name')">{{ errors.first('user_name') }}</p>
        </div>

        <div class="field">
          <label class="label">Email</label>
          <p class="control">
            <input class="input" type="email" placeholder="email@yourdomain.com" v-model="user.email" disabled>
          </p>
        </div>

        <div class="field">
          <label class="label">Alamat</label>
          <p class="control">
            <textarea class="textarea" placeholder="Jalan THamrin No. 114 Medan" v-model="user.address"></textarea>
          </p>
        </div>

        <div class="field containerFormMaps">
          <maps class="blurOnHover" />
          <div class="captionMaps">
            <a @click="showModalMaps">Ganti</a>
          </div>
        </div>

        <modalPickLocation :isActive.sync="modalShow"
        :latitude.sync="user.latitude" :longitude.sync="user.longitude"/>

      </div>
      <div class="column is-half">

        <div class="field wrapper-image">
          <div class="image is-256x256">
            <img :src="profile_image" alt="profile Logo">
          </div>
          <div class="wrapper-change-photo">
            <label for="uploadphoto" class="button is-link ">
            Ganti Foto
            </label>
            <input type="file" @change="upload" id="uploadphoto" style="display: none" accept="image/*">
          </div>
        </div>

      </div>
    </div>
    <div class="columns">
      <div class="column is-half">

        <div class="field has-text-centered">
          <button @click="updateProfile" class="button is-primary is-fullwidth">Update Profile</button>
        </div>

      </div>
    </div>
  </div>
</template>

<style lang="scss">
  .form-update-profile {
    display: flex;
  }
  .containerFormMaps {
    position: relative;
    .blurOnHover {
      filter: none;
    }
    .captionMaps {
      display: none;
      position: absolute;
        top: 0;
        width: 100%;
        text-align: center;
        margin-top: 5rem;
        a {
          cursor: pointer;
        }
    }
  }
  .containerFormMaps:hover {
    .captionMaps {
      display: block
    }
    .blurOnHover {
      filter: blur(0.1rem);
    }
  }
  .image-photo {
    img {
      min-width: 64px;
      max-height: 128px !important;
    }
  }
  .wrapper-change-photo {
    display: flex;
    justify-content: center;
    label {
      font-size: 0.8rem;
    }
  }
  .wrapper-image {
    display: flex;
    flex-direction: column;
  }
  .is-256x256 {
    display: flex;
    justify-content: center;
    text-align: center;
    width: 100%;
    img {
      object-fit: scale-down;
      width: 70%;
    }
  }
</style>

<script>

import { mapGetters, mapActions } from 'vuex'
import iziToast from 'izitoast'
const Maps = () => import('global/components/Others/Maps.vue')
const ModalPickLocation = () => import('global/components/Modals/ModalPickLocation.vue')

export default {
  mounted () {
    const { name, picture_url, email, phone, address, latitude, longitude } = this.activeUser
    this.user.name = name
    this.user.picture_url = picture_url
    this.user.email = email
    this.user.phone = phone
    this.user.address = address
    this.user.latitude = latitude
    this.user.longitude = longitude
  },
  data () {
    return {
      modalShow: false,
      user: {
        name: '',
        email: '',
        'picture_url': '',
        address: '',
        phone: '',
        gender: 0,
        longitude: null,
        longitude: null
      }
    }
  },
  components: {
    Maps,
    ModalPickLocation
  },
  methods: {
    ...mapActions(['initActiveUser']),
    showModalMaps () {
      this.modalShow = true
    },
    upload (e) {
      this.$uploader.nipe(e).then(response => {
        console.log(response)
        this.user.picture_url = response.data.image
      }).catch(err => console.log(err))
    },
    generateLinkPicture () {
      return `/${this.user.picture_url}`
    },
    updateProfile () {
      this.$validator.validateAll().then(result => {
        this._updateProfile()
      }).catch(err => {
        console.log(err)
      })
    },
    _updateProfile () {
      const data = this.user
      const id = this.activeUser.id
      this.$http.post(`api/user`, data).then(response => {
        iziToast.success({
            title: 'Sukses',
            message: 'Profile berhasil diperbaharui',
            position: 'bottomRight'
        });
        this.initActiveUser(response.data.user)
      }).catch(err => err)
    }
  },
  computed: {
    profile_image () {
      return `/image/small/${this.user.picture_url}`
    },
    ...mapGetters([
      'activeUser'
    ])
  }
}
</script>
