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
          <maps class="blurOnHover" @mouseover="showCaption"/>
          <div class="captionOnHover">
            <p>Klik to Update</p>
          </div>
        </div>

        <div class="field has-text-centered">
          <button @click="updateProfile" class="button is-primary is-fullwidth">Update Profile</button>
        </div>

      </div>
      <div class="column">
        <div class="change-image">
          <!-- <div class="image is-64x64 is-square image-photo">
            <img :src="profileImage" alt="profile Logo">
          </div> -->

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
  </div>

</template>


<style lang="scss">
  .form-update-profile {
    display: flex;
  }
  .blurOnHover:hover {
    filter: blur(0.1rem);
  }
  .containerFormMaps {
    position: relative;
    .captionOnHover {
      top: 0;
      width: 100%;
      text-align: center;
      margin-top: 5rem;
      position: absolute;
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
import { mapGetters } from 'vuex'
import iziToast from 'izitoast'

const Maps = () => import('global/components/Others/Maps.vue')

export default {
  components: {
    Maps
  },
  mounted () {
    const { name, picture_url, email, phone, address } = this.activeUser
    this.user.name = name
    this.user.picture_url = picture_url
    this.user.email = email
    this.user.phone = phone
    this.user.address = address
  },
  data () {
    return {
      user: {
        name: '',
        email: '',
        'picture_url': '',
        address: '',
        phone: '',
        gender: 0
      }
    }
  },
  methods: {
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
      }).catch(err => err)
    },
    showCaption () {
      console.log('asd from bali')
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

