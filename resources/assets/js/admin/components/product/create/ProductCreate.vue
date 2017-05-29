<template>
  <div>
    <div>
      <section class="section">
        <div class="container">
          <div class="columns">
            <div class="column is-one-quarter">
              <admin-sidebar></admin-sidebar>
            </div>

            <div class="column">
              <div class="columns" v-if="onError">
                <div class="column">
                  <div class="notification is-danger">
                  <button class="delete" @click="setOnError(false)"></button>
                    Error
                  </div>
                </div>
              </div>
              <div class="columns">
                <formAddProduct />
              </div>

            </div>

          </div>
        </div>
      </section>
    </div>
    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>

<script>
  const FooterApps = () => import('otherComponents/Footer.vue')
  const AdminSidebar = () => import('otherComponents/Sidebars/AdminSidebar.vue')
  const FormAddProduct = () => import('adminProduct/create/FormAddProduct.vue')

  import { mapGetters, mapActions } from 'vuex'

  export default {
    components: {
      FooterApps,
      FormAddProduct,
      AdminSidebar
    },
    computed: {
      ...mapGetters([
          'onError'
        ])
    },
    methods: {
      ...mapActions([
          'setOnError'
        ])
    }
  }
</script>
