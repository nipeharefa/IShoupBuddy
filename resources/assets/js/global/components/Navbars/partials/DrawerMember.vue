<template>
  <div class="menu-touch"  role="menu">
    <ul class="menu-list">
      <menu-slot :hasChild="false">
          <div slot="content" class="is-fullwidth">
            <i class="fa fa-home"></i>
            <a href="/">Beranda</a>
          </div>
      </menu-slot>

      <menu-slot :hasChild="true">
          <div slot="content" class="is-fullwidth">
            <i class="fa fa-home"></i>
            <a>Promo dan Diskon</a>
          </div>
          <ul slot="child">
            <li>
              <a href="/me">Promo Hari ini</a>
            </li>
            <li>
              <a href="/me">Semua Produk Diskon</a>
            </li>
          </ul>
      </menu-slot>

      <menu-slot :hasChild="true">
          <div slot="content">
            <i class="fa fa-gear"></i>
            <a>Pengturan</a>
          </div>
          <ul slot="child">
            <li>
              <a href="/me/change_password">Tukar Password</a>
            </li>
          </ul>
      </menu-slot>

      <menu-slot :hasChild="true">
          <div slot="content">
            <i class="fa fa-th"></i>
            <a>Lainnya</a>
          </div>
          <ul slot="child">
            <li>
              <a href="/me">Syarat dan Ketentun</a>
            </li>
            <li>
              <a href="/me">Tentang Kami</a>
            </li>
          </ul>
      </menu-slot>

      <menu-slot :hasChild="false">
          <div slot="content" class="is-fullwidth">
            <hr>
          </div>
      </menu-slot>

      <menu-slot :hasChild="false">
          <div slot="content" @click="logout" class="is-fullwidth">
            <i class="fa fa-sign-out"></i>
            <a>Logout</a>
          </div>
      </menu-slot>
    </ul>
  </div>
</template>

<script>
  const MenuSlot = () => import('./MenuSlot.vue')

  export default {
    components: {
      MenuSlot
    },
    methods: {
      logout () {
        this.$http.delete('auth/logout').then(response => {
          window.location.assign('/')
        }).catch(err => {
          console.log(err)
        })
      }
    }
  }
</script>
