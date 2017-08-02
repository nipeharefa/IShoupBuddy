<template>
  <div>
    <section id="navbar">
      <navbar />
    </section>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column">
            <breadCrumb></breadCrumb>
          </div>
        </div>
        <div class="columns" v-if="!cartsNotNull" style="text-align: center">
          <div class="column">Keranjang Belanja anda Kosong</div>
        </div>
        <div class="columns" v-if="cartsNotNull">
          <div class="column is-half">

            <nav class="panel" v-for="(item, $index) in carts">
              <p class="panel-heading">
                <input type="checkbox" :value="item.id" v-model="a"> {{ item.vendor.name }}
              </p>

              <panel-detail :cartItem="item.item"
              :cartIndex="$index" :cart="item" :key="item.id"></panel-detail>

            </nav>

          </div>
          <!-- End Detail -->
          <!-- Start Total Belanja -->
          <div class="column is-half">
            <total-belanja :cartChecked="a" :totalString="totalString" :total="total"></total-belanja>
          </div>
          <!-- End Total Belanja -->
        </div>
      </div>
    </section>
    <div id="footer-apps">
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<script>
  import { mapGetters, mapStates } from 'vuex'
  const PanelCart = () => import('./PanelCart.vue')
  const PanelDetail = () => import('./PanelDetail.vue')
  const FooterApps = () => import('otherComponents/Footer.vue')
  const TotalBelanja = () => import('./TotalBelanja.vue')
  const Navbar = () => import('global/components/Navbars/MemberNavbar.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')

  export default {
    mounted () {
      this.$store.watch( state => {
        return state.keyUpdater
      }, (x) => {
        console.log(x)
        this.getSubTotal(this.a)
      })
    },
    data () {
      return {
        a: this.$store.state.cartChecked,
        totalString: "Rp. 0",
        total: 0
      }
    },
    components: {
      Navbar,
      PanelDetail,
      FooterApps,
      TotalBelanja,
      BreadCrumb
    },
    computed: {
      ...mapGetters(['cartChecked', 'carts']),
      cartsNotNull () {
        if (this.carts) {
          return this.carts.length > 0
        }
        return false
      }
    },
    methods: {
      updateDonk (a) {
        console.log(a)
      },
      getSubTotal (a) {
        this.$http.post('api/cart/getSubTotal', {arrayIds: a}).then(response => {
          this.total = response.data.total
          this.totalString = response.data.total_string
        })
      }
    },
    watch :{
      a (a,b) {
        this.getSubTotal(a)
      }
    }
  }
</script>
