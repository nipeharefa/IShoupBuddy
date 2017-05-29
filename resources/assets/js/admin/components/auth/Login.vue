<template>
  <div>
    <section class="section">
      <div class="columns ">
        <div class="column is-4 is-offset-one-third">
          <div>
            <h2 class="title is-3 has-text-centered">Admin Login</h2>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="email" placeholder="Email" v-model="login.email" @keyup.enter="login">
              <span class="icon is-small is-left">
                <i class="fa fa-envelope"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control has-icons-left">
              <input class="input" type="password" placeholder="Password" v-model="login.password">
              <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
              </span>
            </p>
          </div>
          <div class="field">
            <p class="control">
              <button class="button is-success" @click="doLogin">
                Login
              </button>
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>

  export default {
    mounted () {},
    data () {
      return {
        login: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      doLogin () {
        const data = this.login

        this.$http.post('admin/login', data).then(response => {
          console.log(response.data)
        }).catch(err => err)
      }
    }
  }
</script>
