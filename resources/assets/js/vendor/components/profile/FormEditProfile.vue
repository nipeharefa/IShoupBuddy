<template>

  <div class="form-update-profile columns">
      <div class="column">
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
          <label class="label">Telepon</label>
          <p class="control">
            <input class="input" type="email" placeholder="+6282276121xx" v-model="user.phone">
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

        <div class="field has-text-centered">
          <button @click="updateProfile($event)" class="button is-primary is-fullwidth">Update Profile</button>
        </div>

      </div>
      <div class="column">
        <div class="change-image">

          <figure class="media-left">
            <p class="image is-128x128 image-photo">
              <img :src="profileImage" alt="profile Logo">
            </p>
          </figure>

          <div class="wrapper-change-photo">
            <label for="uploadphoto" class="button is-link">
            Ganti Foto
            </label>
            <input type="file" @change="upload"
              id="uploadphoto" style="display: none"
              accept="image/*">
          </div>
        </div>

      </div>
      <modalPickLocation :isActive.sync="modalShow"
        :latitude.sync="user.latitude" :longitude.sync="user.longitude"/>
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
</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import iziToast from 'izitoast'

const Maps = () => import('global/components/Others/Maps.vue')
const ModalPickLocation = () => import('global/components/Modals/ModalPickLocation.vue')

export default {
  components: {
    Maps,
    ModalPickLocation
  },
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
  methods: {
    ...mapActions([
      'updateActiveUser'
    ]),
    upload (e) {
      this.$uploader.nipe(e).then(response => {
        console.log(response)
        this.user.picture_url = response.data.image
      }).catch(err => console.log(err))
    },
    generateLinkPicture () {
      return `/${this.user.picture_url}`
    },
    updateProfile (event) {
      this.$validator.validateAll().then(result => {
        this._updateProfile(event)
      }).catch(err => {
        console.log(err)
      })
    },
    _updateProfile (event) {
      const btn = event.target
      const data = this.user
      const id = this.activeUser.id

      btn.classList.add('is-loading')

      this.$http.post(`api/user`, data).then(response => {
        iziToast.success({
            title: 'Sukses',
            message: 'Profile berhasil diperbaharui',
            position: 'bottomRight'
        });
        btn.classList.remove('is-loading')
      }).catch(err => {
        btn.classList.remove('is-loading')
      })
    },
    showModalMaps () {
      this.modalShow = true
    }
  },
  computed: {
    profileImage () {
      if (this.user.picture_url == null) {
        return ''
      }
      return `/image/small/${this.user.picture_url}`
    },
    ...mapGetters([
      'activeUser'
    ])
  }
}
</script>

