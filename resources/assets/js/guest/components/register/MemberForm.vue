<template>
	<div>
		<div class="form-member">
			<div class="field">
				<p class="control">
					<input type="text" name="" id="" class="input" placeholder="Nama Lengkap"
					v-model="register.name">
				</p>
			</div>

			<div class="field">
				<p class="control">
					<input type="email" name="" id="" class="input" placeholder="Email Address"
					v-model="register.email" >
				</p>
			</div>

			<div class="field">
				<p class="control">
					<input type="text"  class="input" placeholder="Nomor Handphone"
					v-model="register.phone">
				</p>
			</div>

			<div class="field">
				<p class="control">
					<input type="password" name="" id="" class="input" placeholder="Password"
					v-model="register.password">
				</p>
			</div>

			<div class="field">
				<p>
					<button class="button is-primary" @click="doRegister">Daftar</button>
				</p>
			</div>

		</div>
	</div>
</template>


<script>
	export default {
		data() {
			return {
				register: {
					name: '',
					email: '',
					password: '',
					phone: ''
				},
				onError: false
			}
		},
		methods: {
			doRegister() {

				const data = this.register
				const self = this


				this.$http.post('/auth/register', data)
					.then(x => {
            console.log(x.data)
					}).catch( x => {
						console.log(x)
            self.onError = true
					})
			},
      hideErrorNotification() {
        this.onError = false
      }
		}
	}
</script>