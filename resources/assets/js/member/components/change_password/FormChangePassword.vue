<template>
  <div>
    <div class="field">
      <label class="label">Password Lama</label>
      <p class="control">
        <input class="input" type="password" placeholder="" name="current_password">
      </p>
    </div>

    <div class="field">
      <label class="label">Password Baru</label>
      <p class="control">
        <input class="input" type="password" placeholder="" name="password">
      </p>
    </div>

    <div class="field">
      <label class="label">Konfirmasi Password Baru</label>
      <p class="control">
        <input class="input" type="password" placeholder="" name="password_confirmation">
      </p>
    </div>

     <div class="field has-text-centered">
      <button class="button is-primary is-fullwidth" @click="_changePassword">Tukar Password</button>
    </div>

    <div class="field has-text-centered">
      <a href="/me" class="link is-link is-danger">Batal</a>
    </div>


  </div>
</template>

<script>
    export default {
        data () {
           return {
                password: {
                    current_password: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        },
        methods: {
            validate () {
                // validate
            },
            _changePassword () {
               const data = this.password
               this.$http.post('api/user/change_password', data).then(response => {
                 console.log(response.data)
               })
            }
        }
    }
</script>
