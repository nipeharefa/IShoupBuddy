<template>
	<div>
		<div class="notification is-danger" v-if="onError">
		  <button class="delete" @click="closeNotification"></button>
		  Kesalahan saat login, mohon periksa kombinasi email dan password anda
		</div>
		<div class="field">
  			<label class="label">Email</label>
  			<input  v-validate="'required|email'"
        type="text" class="input"
        placeholder="Alamat Email"
        v-model="login.email"
        data-vv-as="Alamat Email"
        name="email" :class="{'is-danger': errors.has('email') }"/>

        <p class="help is-danger" v-show="errors.has('email')">{{ errors.first('email') }}</p>
		</div>
		<div class="field">
			<label class="label">Kata Sandi</label>
			<p class="control">
  				<input  v-validate="'required'"
          type="password" class="input"
          placeholder="Kata Sandi"
          v-model="login.password"
          @keyup.enter="doLogin" name="password"
          data-vv-as="Kata Sandi"
          :class="{'is-danger': errors.has('password') }" />
  		</p>
      <p class="help is-danger" v-show="errors.has('password')">{{ errors.first('password') }}</p>
		</div>

		<div class="field is-grouped">

		  <p class="control">
		    <button class="button is-primary" @click="doLogin($event)">Login</button>
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
        this.$validator.validateAll()
        if (this.errors.any()) {
          return
        }
        this._register($event)
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
