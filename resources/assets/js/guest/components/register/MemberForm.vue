<template>
	<div>
		<div class="form-member">
			<div class="field">
				<p class="control">
					<input v-validate="'required|alpha'" type="text" name="name" id="" class="input" placeholder="Nama Lengkap"
					v-model="register.name" :class="{'is-danger': errors.has('name') }" data-vv-as="Nama">
				</p>
        <p class="help is-danger" v-show="errors.has('name')">{{ errors.first('name') }}</p>
			</div>

			<div class="field">
				<p class="control">
          <input v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" type="email" name="email" class="input" placeholder="Email Address"
					v-model="register.email" data-vv-as="Alamat Email">
				</p>
        <p class="help is-danger" v-show="errors.has('email')">{{ errors.first('email') }}</p>
        <p class="help is-danger" v-if="errorMessage.email">{{ errorMessage.email[0] }}</p>
			</div>

			<div class="field">
				<p class="control">
					<input type="text"
          v-validate="'required|numeric|max:11'"
          :class="{'is-danger': errors.has('phone') }"
          class="input" placeholder="Nomor Handphone"
          v-model="register.phone"
          data-vv-as="Nomor Handphone"
          name="phone">
				</p>
        <p class="help is-danger"
        v-show="errors.has('phone')">{{ errors.first('phone') }}</p>
			</div>

			<div class="field">
				<p class="control">
					<input v-validate="'required|min:6'" type="password" class="input" placeholder="Kata Sandi"
					v-model="register.password"
          :class="{'is-danger': errors.has('name') }" data-vv-name="password" data-vv-as="Kata Sandi">
				</p>
        <p class="help is-danger" v-show="errors.has('password')">{{ errors.first('password') }}</p>
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
      onError: false,
      errorMessage: {}
    }
  },
  methods: {
    doRegister ($event) {
      this.$validator.validateAll()
      if (this.errors.any()) {
        return
      }
      this._register($event)
    },
    _register ($event) {
      const data = this.register
      const self = this
      const btn = event.target
      btn.classList.add('is-loading')
      this.$http.post('/auth/register', data)
        .then(response => {
          window.location.assign(response.data.link)
          btn.classList.remove('is-loading')
        }).catch(x => {
          self.onError = true
          btn.classList.remove('is-loading')
          this.errorMessage = x.response.data
        })
    },
    hideErrorNotification () {
      this.onError = false
    }
  }
}
</script>
