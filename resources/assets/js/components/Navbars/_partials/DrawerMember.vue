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
              <a href="/me">Tukar Password</a>
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

      <!-- <menu-slot :hasChild="false">
          <div slot="content">
            <a href="/me/change_password">Tukar Password</a>
          </div>
      </menu-slot> -->
      <!-- <li>
        <a href="/me/change_password">Tukar Password</a>
      </li>
      <li>
        <i class="fa fa-heart"></i>
        <a href="/me/product_favorite">Barang Favorit</a>
      <li>
        <i class="fa fa-money"></i>
        <a href="/me/transactions">Daftar Transaksi</a>
      </li>
      <li>
        <hr>
      </li>
      <li>
        <i class="fa fa-sign-out"></i>
        <a>Logout</a>
      </li> -->
    </ul>
  </div>
</template>

<script>
  const MenuSlot = () => import('./MenuSlot.vue')

  export default {
    components: {
      MenuSlot
    }
  }
</script>
