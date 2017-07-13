<template>
  <div>
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li class="is-active"><a>Tukar Password</a></li>
      </ul>
    </nav>
    <div class="columns">
      <div class="column is-half">
        <div class="field">
          <label class="label">Password Lama</label>
          <p class="control">
            <input class="input" type="password" placeholder="Password" name="current_password" v-validate="'required'"
            :class="{'is-danger': errors.has('current_password') }" v-model="passwd.current_password">
          </p>

          <p class="help is-danger" v-show="errors.has('current_password')">This Current Password is invalid</p>
        </div>

        <div class="field">
          <label class="label">Password Baru</label>
          <p class="control">
            <input class="input" type="password" placeholder="Password Baru" name="password" v-validate="'required'" :class="{'is-danger': errors.has('password') }" v-model="passwd.password">
          </p>
          <p class="help is-danger" v-show="errors.has('password')">This Password is invalid</p>
        </div>

        <div class="field">
          <label class="label">Konfirmasi Password Baru</label>
          <p class="control">
            <input class="input" type="password" placeholder="Konfirmasi Password" name="password_confirmation" v-validate="'required'" :class="{'is-danger': errors.has('password_confirmation') }" v-model="passwd.password_confirmation">
          </p>
          <p class="help is-danger" v-show="errors.has('password_confirmation')">This Password is invalid</p>
        </div>

         <div class="field has-text-centered">
          <button class="button is-primary is-fullwidth" @click="validate">Tukar Password</button>
        </div>

      </div>

    </div>

  </div>
</template>

<script>
  import iziToast from 'izitoast'
  import { mapGetters } from 'vuex'

  export default {
    data () {
      return {
        passwd: {
          'current_password': '',
          'password': '',
          'password_confirmation': ''
        }
      }
    },
    computed: {
      ...mapGetters(['activeUser'])
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
        const data = this.passwd
        this.$http.post('api/user/change_password', data).then(response => {
          iziToast.success({
            title: 'Sukses',
            message: 'Password berhasil diperbaharui',
            position: 'bottomRight'
          });
        }).catch(err => {
          iziToast.error({
            title: 'Error',
            message: err.response.message,
            position: 'bottomRight'
          });
        })
      }
    }
  }
</script>
