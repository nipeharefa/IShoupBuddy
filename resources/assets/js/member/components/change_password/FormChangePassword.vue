<template>
  <div>
    <div class="field">
      <label class="label">Password Lama</label>
      <p class="control">
        <input class="input" type="password" placeholder="Password" name="current_password" v-validate="'required'"
        :class="{'is-danger': errors.has('current_password') }">
      </p>

      <p class="help is-danger" v-show="errors.has('current_password')">This Current Password is invalid</p>
    </div>

    <div class="field">
      <label class="label">Password Baru</label>
      <p class="control">
        <input class="input" type="password" placeholder="Password Baru" name="password" v-validate="'required'" :class="{'is-danger': errors.has('password') }">
      </p>
      <p class="help is-danger" v-show="errors.has('password')">This Password is invalid</p>
    </div>

    <div class="field">
      <label class="label">Konfirmasi Password Baru</label>
      <p class="control">
        <input class="input" type="password" placeholder="Konfirmasi Password" name="password_confirmation" v-validate="'required'" :class="{'is-danger': errors.has('password_confirmation') }">
      </p>
      <p class="help is-danger" v-show="errors.has('password_confirmation')">This Password is invalid</p>
    </div>

     <div class="field has-text-centered">
      <button class="button is-primary is-fullwidth" @click="validate">Tukar Password</button>
    </div>

    <div class="field has-text-centered">
      <a href="/me" class="link is-link is-danger">Batal</a>
    </div>


  </div>
</template>

<script>
  export default {
    data () {
      return {
        password: {
          'current_password': '',
          'password': '',
          'password_confirmation': ''
        }
      }
    },
    methods: {
      validate () {
        this.$validator.validateAll().then(result => {
          this._changePassword()
        }).catch(err => {
          console.log(err)
        })
      },
      _changePassword () {
        const data = this.password
        this.$http.post('api/user/change_password', data).then(response => {
          console.log(response.data)
        }).catch(err => err)
      }
    }
  }
</script>
