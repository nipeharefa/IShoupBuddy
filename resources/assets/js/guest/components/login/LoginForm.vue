<template>
	<div>
		<div class="notification is-danger" v-if="onError">
		  <button class="delete" @click="closeNotification"></button>
		  Kesalahan saat login, mohon periksa kombinasi email dan password anda
		</div>
		<div class="field">
  			<label class="label">Email</label>
  			<input type="text" class="input" placeholder="Email Address" v-model="login.email"  />
		</div>
		<div class="field">
			<label class="label">Password</label>
			<p class="control">
  				<input type="password" class="input"  placeholder="Password" v-model="login.password" />
  			</p>
		</div>
		
		<div class="field is-grouped">
		  
		  <p class="control">
		    <button class="button is-primary" @click="doLogin">Login</button>
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
		data() {

			return {
				login: {
					email :'',
					password: ''
				},
				onError: false
			}
		},
		methods: {
			closeNotification() {
				this.onError = false
			},
			doLogin() {
				const data = this.login
				const self = this
				this.$http.post('/auth/login', data).then(x => {
					console.log(x)
				}).catch(x => {
					self.onError = true
				})
			}
		}
	}
</script>