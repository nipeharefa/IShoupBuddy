<template>
  <div class="modal" :class="{'is-active': active}">
    <div class="modal-background"></div>
      <div class="modal-content">
        <div class="message-modal-vendor">
          <div>
            <p>Terima Kasih sudah mendaftar sebagai Vendor. </p>
            <p>Data anda sedang di verifikasi oleh pihak Admin. Sebelum anda menerima email verifikasi anda tidak bisa  melakukan login maupun transaksi lainnya.</p>
          </div>

          <div class="vendor-to-home">
            <a href="/" class="tag is-primary">Kembali ke halaman awal</a>
          </div>
        </div>
      </div>
  </div>
</template>


<script>
  export default {
    props: {
      active: {
        type: Boolean,
        default: false
      }
    }
  }
</script>

<style lang="scss">
  .message-modal-vendor {
    background: white;
    padding: 1rem;
  }
  .vendor-to-home {
    margin-top: 2rem;
    font-size: 0.9rem;
  }
</style>
