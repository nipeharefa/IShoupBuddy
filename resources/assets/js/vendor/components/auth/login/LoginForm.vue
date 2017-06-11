<template>
  <div>
    <div class="notification is-danger" v-if="onError">
      <button class="delete" @click="closeNotification"></button>
      Kesalahan saat login, mohon periksa kombinasi email dan password anda
    </div>
    <div class="field">
        <label class="label">Email</label>
        <input  v-validate="'required|email'" type="email" class="input" placeholder="Email Vendor"
        v-model="login.email"  name="email" :class="{'is-danger': errors.has('email') }"/>

        <p class="help is-danger" v-show="errors.has('email')">This email is invalid</p>
    </div>
    <div class="field">
      <label class="label">Password</label>
      <p class="control">
          <input  v-validate="'required'" type="password" class="input"  placeholder="Password" v-model="login.password" @keyup.enter="doLogin" name="password" :class="{'is-danger': errors.has('password') }" />
      </p>
      <p class="help is-danger" v-show="errors.has('password')">This password is invalid</p>
    </div>

    <div class="field is-grouped">

      <p class="control">
        <button class="button is-primary" @click="doLogin">Login</button>
      </p>

      <p class="control control-button-forgot-password">
        <!-- <button class="button is-link button-forgot-password">Lupa Password ?</button> -->
      </p>
    </div>

  </div>
</template>


<script>
  export default {
    data () {
      return {
        login: {
          email: '',
          password: ''
        },
        onError: false
      }
    },
    methods: {
      closeNotification () {
        this.onError = false
      },
      doLogin () {
        this.$validator.validateAll().then(result => {
          this._doLogin()
        }).catch(err => {
          return err
        })
      },
      _doLogin () {
        const data = this.login
        const self = this
        this.$http.post('/auth/vendor/login', data).then(x => {
          window.location.assign('/vendor/product')
        }).catch(x => {
          self.onError = true
        })
      }
    }
  }
</script>
