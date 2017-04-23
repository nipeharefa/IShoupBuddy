<template>
	<div>
		<div class="form-member">
			<div class="field">
				<p class="control">
					<input v-validate="'required'" type="text" name="name" id="" class="input" placeholder="Nama Lengkap"
					v-model="register.name" :class="{'is-danger': errors.has('name') }">
				</p>
        <p class="help is-danger" v-show="errors.has('name')">This name is invalid</p>
			</div>

			<div class="field">
				<p class="control">
          <input v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" type="email" name="email" class="input" placeholder="Email Address"
					v-model="register.email">
				</p>
        <p class="help is-danger" v-show="errors.has('email')">This email is invalid</p>
			</div>

			<div class="field">
				<p class="control">
					<input type="text"  v-validate="'required'" :class="{'is-danger': errors.has('phone') }"  class="input" placeholder="Nomor Handphone" v-model="register.phone" name="phone">
				</p>
        <p class="help is-danger" v-show="errors.has('phone')">{{ errors.first('phone') }}</p>
			</div>

			<div class="field">
				<p class="control">
					<input v-validate="'required|min:6'" type="password" class="input" placeholder="Password"
					v-model="register.password" :class="{'is-danger': errors.has('name') }" data-vv-name="Password">
				</p>
        <p class="help is-danger" v-show="errors.has('Password')">{{ errors.first('Password') }}</p>
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
  name: 'MemberForm',
  data () {
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
    doRegister () {
      this.$validator.validateAll().then(result => {
        this._register()
      }).catch(err => {
        console.log(err)
      })
    },
    _register () {
      const data = this.register
      const self = this
      this.$http.post('/auth/register', data)
        .then(response => {
          window.location.assign(response.data.link)
        }).catch(x => {
          self.onError = true
        })
    },
    hideErrorNotification () {
      this.onError = false
    }
  }
}
</script>
