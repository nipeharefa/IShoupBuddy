<template>
   <div class="modal is-active">
      <div class="modal-background" @click="hide"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Tambah Saldo</p>
          <button class="delete" @click="hide"></button>
        </header>
        <section class="modal-card-body">
          <div class="topup-wrapper-input">
            <div class="field">
              <p class="control">
                <label for="">Nominal</label>
                <input class="input" type="tel"
                placeholder="Minimum Rp10.000"
                v-model="nominal"
                :value="amountValue"
                @input="processValue(amountValue)"
                >
              </p>
            </div>
            <div class="topup-payment-method">
               <p class="control">
                <label for="">Metode Pembayaran</label>
                <p class="payment-method-item">Transfer</p>
               </p>
            </div>
          </div>
          <div class="field confirm-topup">
            <p class="control">
              <span class="nominal-string">{{ nominalString }}</span>
            </p>
            <p class="control">
              <button class="button is-primary" @click="addSaldo($event)">Lanjut</button>
            </p>
          </div>
        </section>
      </div>
    </div>
</template>

<style lang="scss" scoped>
  .confirm-topup {
    display: flex;
    justify-content: space-between;
  }
  .topup-wrapper-input {
    flex: 1;
    display: flex;
    margin: 1rem 0;
    .topup-payment-method {
      flex: 1;
      padding: 0 1rem;
      .payment-method-item {
        font-weight: bolder;
      }
    }
  }
  .nominal-string {
    font-weight: bolder;
  }
</style>

<script>
  import accounting from 'accounting-js'
  import { mapActions } from 'vuex'
  import iziToast from 'izitoast'

  export default {
    props: {
      show: {
        required: true
      }
    },
    data () {
      return {
        nominal: 0
      }
    },
    computed: {
      amountValue () {
        return this.formatToNumber(this.nominal)
      },
      nominalString() {
        const t =  this.nominal
        return accounting.formatMoney(t, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      }
    },
    methods: {
      ...mapActions(['addSaldoTransaction']),
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
      },
      processValue(value){
        if (isNaN(value)) {
          this.nominal = 1
          return
        } else if (value === 0) {
          this.nominal = 1
        } else {
          this.nominal = value
        }
      },
      hide () {
        this.$emit('update:show', false)
      },
      addSaldo (event) {
        const btn = event.target
        btn.classList.add('is-loading')

        const data = {
          nominal: parseInt(this.nominal)
        }
        this.$http.post('api/saldo', data).then(response => {
          console.log(response.data)
          btn.classList.remove('is-loading')
          this.addSaldoTransaction(response.data.transaction)
          this.hide()
          iziToast.success({
            title: 'Sukses',
            message: 'Permintaan Pemabahan Saldo berhasil',
            position: 'bottomRight'
          });
        }).catch(err => {
          btn.classList.remove('is-loading')
        })
      }
    }
  }
</script>
