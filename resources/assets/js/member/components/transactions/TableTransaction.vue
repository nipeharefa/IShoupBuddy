<template>
  <div>
    <nav class="breadcrumb breadwrapper">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li class="is-active"><a>Transaksi</a></li>
      </ul>
    </nav>
    <div class="columns">
      <div class="column">
        <div class="order-teaser" v-for="(item, index) in transactions">
          <div class="order-teaser__header">
            <div class="order-top">
              <span>
                Pesanan
                <router-link :to="{ name: 'detailTransaction', params: { id: item.id } }" append>
                    #{{ item.id }}
                </router-link>
              </span>
              <span>Dipesan pada {{ item.updated_at_string }}</span>
            </div>
            <div class="order-confirmation__header">
              <button class="button is-primary"
              @click="confirm(item, index)"
              v-if="canConfirm(item)">Konfirmasi Terima Barang</button>
            </div>
          </div>
          <div class="order-teaser__body columns">
            <div class="order-teaser__product column is-half" v-for="product in item.detail">
              <a class="order-product-teaser__img">
                <img :src="product.product.picture_url.small" alt="">
              </a>
              <div class="order-product-teaser__body">
                <a :href="`/product/${product.product.id}`" class="order-product-teaser__title">{{ product.name }}</a>
                <br>
                <button
                class="button is-small is-primary"
                v-if="item.shipment.accepted_at" @click="review(product)">Beri Ulasan</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modalCreateUpdateReview
    :activeProductVendor="activeProductVendor"
    :modalReviewShow.sync="modalReviewShow" v-if="modalReviewShow"/>
  </div>
</template>

<script>

  import iziToast from 'izitoast'
  import { mapGetters, mapActions } from 'vuex'

  const ModalCreateUpdateReview = () => import('global/components/Modals/CreateProductVendorReview.vue')

  export default {
    components: {
      ModalCreateUpdateReview
    },
    data () {
      return {
        modalReviewShow: false,
        activeProductVendor: null
      }
    },
    computed: {
      ...mapGetters(['transactions', 'activeUser'])
    },
    methods: {
      ...mapActions(['updateTransaction']),
      review (item) {
        this.modalReviewShow = true
        this.activeProductVendor = item
      },
      canConfirm (item) {
        if (item.status === 0) {
          return true
        }
        return false
      },
      checkCanReview (item) {
        return item.status === 1;
      },
      confirm (item, index, $event) {
        const id = item.shipment.id
        const data = this.user
        const btn = event.target

        btn.classList.add('is-loading')

        const self = this

        this.$http.post(`api/transaction-shipment/postAcceptShipment/${id}`)
          .then(response => {
            iziToast.success({
              title: 'Sukses',
              message: 'Konfirmasi berhasil',
              position: 'bottomRight'
            });

            const obj = {
              index,
              data: response.data.transaction
            }

            self.updateTransaction(obj)

            btn.classList.remove('is-loading')

          }).catch(err => {
            btn.classList.remove('is-loading')
            console.warn(err.response)
          })
      }
    }
  }
</script>
