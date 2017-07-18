<template>
	<div>
		<div class="notification is-danger" v-if="onError">
		  <button class="delete" @click="closeNotification"></button>
		  Kesalahan saat login, mohon periksa kombinasi email dan password anda
		</div>
		<div class="field">
  			<label class="label">Email</label>
  			<input  v-validate="'required|email'" type="text" class="input" placeholder="Email Address"
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
		    <button class="button is-primary" @click="doLogin($event)">Login</button>
		  </p>

		  <p class="control control-button-forgot-password">
		    <button class="button is-link button-forgot-password">Lupa Password ?</button>
		  </p>
		</div>

		<div class="to-register">
			<p>Belum Punya Akun</p>
			<a href="/register">Daftar Sekarang</a>
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
      doLogin (event) {
        this.$validator.validateAll().then(result => {
          if (result) {
            this._doLogin(event)
          }
        }).catch(err => {
          return err
        })
      },
      _doLogin (event) {
        const data = this.login
        const self = this
        const a = event.target
        self.onError = false
        a.classList.add('is-loading')
        this.$http.post('/auth/login', data).then(x => {
          window.location.assign(x.data.redirect_to)
        }).catch(x => {
          a.classList.remove('is-loading')
          self.onError = true
        })
      }
    }
  }
</script>
