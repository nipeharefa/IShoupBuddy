<template>
  <div class="columns">
    <div class="column is-half">
      <div class="request-saldo__head">
        <b>Permintaan TopUp</b>
      </div>
      <div class="request-saldo__detail">
        <table class="table">
          <tbody>
            <tr>
              <td><b>ID</b></td>
              <td>{{ saldoTransactionsDetail.id }}</td>
            </tr>
            <tr>
              <td><b>Nominal</b></td>
              <td>{{ saldoTransactionsDetail.nominal_string }}</td>
            </tr>
            <tr>
              <td><b>Tanggal</b></td>
              <td>{{ saldoTransactionsDetail.updated_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="request-saldo__attachments">
        <div class="field">
          Bukti Transfer
        </div>
        <input type="file" id="upload-attachments" accept="image/*" @change="uploadAttachments">


        <div class="attachments__body" v-if="saldoTransactionsDetail.attachments">
          <img :src="saldoTransactionsDetail.attachments.small" class="image">
          <button class="button is-small is-primary btnChangeImage" @click="browseFile" v-if="!uploading">Ganti</button>
        </div>

        <div class="attachments-empty_body" v-if="!saldoTransactionsDetail.attachments">
          <small v-if="!uploading">*Bukti Transfer belum ada,</small>
          <button class="button is-small is-primary" @click="browseFile" v-if="!uploading">Upload</button>
        </div>

        <div class="field">
          <span>Sedang Mengunggah File..</span>
        </div>
      </div>
      <div class="request-saldo__noted">
        <small>*Mohon untuk mentransfer sesuai dengan nominal yang tertera, ke Bank yang telah di tentukan</small>
      </div>
      <div class="transaksi-control">
        <div class="field">
          <p class="control">
            <button class="button is-small is-danger" v-if="canCancel" @click="cancel">Batalkan</button>
            <span class="label is-danger">{{ statusText }}</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .request-saldo__head,
  .request-saldo__detail {
    display: flex;
    flex-direction: column;
  }
  .request-saldo__detail,
  .request-saldo__noted,
  .request-saldo__attachments {
    margin: 2rem 0;
    font-size: 0.85rem;
  }
  .request-saldo__noted {
    font-style: italic;
  }
  .attachments-empty_body {
    display: flex;
    align-items: center;
  },
  #upload-attachments {
    display: none;
  }
  .btnChangeImage {
    margin: 1rem 0;
  }
</style>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import iziToast from 'izitoast'
  export default {
    created() {
      this.getTransaction()
    },
    data () {
      return {
        uploading: false,
        indexTransaction: null
      }
    },
    computed: {
      ...mapGetters([
        'saldoTransactions',
        'saldoTransactionsDetail',
      ]),
      statusText () {
        const t = this.saldoTransactionsDetail
        switch(t.status) {
          case 0:
            return "Pending"
            break
          case 1:
            return "Topup Sukses"
            break
          case 3:
            return "Attachment Uploaded"
            break
          default:
            return "Topup dibatalkan"
            break
        }
      },
      canCancel () {
        const t = this.saldoTransactionsDetail
        if ((t && t.status === 1) || t.status === 4) {
          return false
        }
        return true
      }
    },
    methods: {
      ...mapActions(['initSaldoTransactionsDetail', 'updateAttachmentTransactionDetail']),
      getTransaction () {
        const id = this.$route.params.id
        const indexCategory = this.saldoTransactions.findIndex( x => id == x.id)
        this.indexTransaction = indexCategory
        this.initSaldoTransactionsDetail(this.saldoTransactions[indexCategory])
      },
      browseFile () {
        var f = document.querySelector("input#upload-attachments").click()
      },
      uploadAttachments ($event) {
        const file = $event.target.files[0]
        const fileName = file.name.toLowerCase()

        if (!(file && fileName.match(/\.(jpg|jpeg|png|gif)$/))) {
          alert('Picture format not supported')
          return
        }

        if (file.size > 3000000) {
          alert('Picture is too large (max 3MB)')
          return
        }

        const formData = new FormData()
        formData.append('image', file)
        const id = this.saldoTransactionsDetail.id
        this.$http.post(`api/transaction/${id}/upload`, formData).then(response => {
          console.log(response)
          this.updateAttachmentTransactionDetail(response.data.transaction.attachments)
        }).catch(error => {
          return error
        })
      },
      cancel ($event) {
        const t = this.saldoTransactionsDetail
        const btn = $event.target
        btn.classList.add('is-loading')

        this.$http.post(`api/admin/transaction/${t.id}/cancel`).then(response => {
          console.log(response)
          iziToast.success({
            title: 'Sukses',
            message: 'Transaksi Berhasil di batalkan',
            position: 'bottomRight'
          });
          btn.classList.remove('is-loading')
          this.initSaldoTransactionsDetail(response.data)
          this.saldoTransactions[this.indexTransaction] = response.data
          this.$router.push({name: 'tableSaldo'})
        }).catch( err => {
          btn.classList.remove('is-loading')
          iziToast.error({
            title: 'Error',
            message: err.response.data,
            position: 'bottomRight'
          });
        })
      }
    }
  }
</script>
