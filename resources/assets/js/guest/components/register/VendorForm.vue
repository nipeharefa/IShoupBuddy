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
          data-vv-as="Nomor Handphone"
          v-model="register.phone" name="phone">
        </p>
        <p class="help is-danger" v-show="errors.has('phone')">{{ errors.first('phone') }}</p>
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
    <modal-vendor :active="modal"></modal-vendor>
	</div>
</template>



<script>
  const ModalVendor = () => import('./ModalVendorConfirmation.vue')

  export default {
    mounted() {},
    data () {
      return {
        register: {
          name: '',
          email: '',
          password: '',
          phone: '',
          isVendor: true
        },
        onError: false,
        modal: false,
        errorMessage: {}
      }
    },
    computed: {
      amountValue () {
        return this.formatToNumber(this.register.phone)
      },
    },
    methods: {
      doRegister () {
        this.$validator.validateAll()
        if (this.errors.any()) {
          return
        }
        this._register()
      },
      _register () {
        const data = this.register
        this.errorMessage = {}
        this.$http.post('auth/vendor/register', data).then(response => {
          console.log(response)
          this.modal = true
        }).catch(x => {
          this.errorMessage = x.response.data
        })
      },
      processValue(value){
        if (isNaN(value)) {
          this.quantity = 1
          return
        } else if (value === 0) {
          this.quantity = 1
        } else {
          this.quantity = value
        }
      },
      formatToNumber (value) {
        let number = 0
        if (this.separator === '.') {
          let cleanValue = value
          if (typeof value !== 'string') {
            cleanValue = this.numberToString(value)
          }
          number = Number(String(cleanValue).replace(/[^0-9-,]+/g, '').replace(',', '.'))
        } else {
          number = Number(String(value).replace(/[^0-9-.]+/g, ''))
        }
        if (!this.minus) return Math.abs(number)
        return number
      }
    },
    components: {
      ModalVendor
    }
  }
</script>
