<template>

  <div class="form-update-profile">

    <div class="field">
      <div class="change-image">
        <img :src="profile_image">
        <button class="button is-primary">Ganti Foto</button>
        <input type="file" @change="upload">
      </div>
    </div>
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
        <input class="input" type="email" placeholder="johndoe@gmail.com" v-model="user.email">
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

    <div class="field has-text-centered">
      <button @click="updateProfile" class="button is-primary is-fullwidth">Update Profile</button>
    </div>

    <div class="field has-text-centered">
      <a href="" class="link is-link is-danger">Batal</a>
    </div>
  </div>

</template>


<script>
export default {
    data () {
      return {
        user: {
          name: '',
          email:'',
          picture_url: '',
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
        this.$http.put('api/user/1', data).then(response => {
          console.log(response.data)
        }).catch(err => err)
      }
    },
    computed: {
      profile_image() {
        return `/image/small/${this.user.picture_url}`;
      }
    }
  }
</script>

