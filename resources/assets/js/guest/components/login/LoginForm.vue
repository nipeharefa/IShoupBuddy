<template>
	<div>
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

		<div class="field">
			<button class="button is-primary" @click="doLogin">Login</button>
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
				}
			}
		},
		methods: {
			doLogin() {

				const data = this.login

				console.log(data)
			}
		}
	}
</script>