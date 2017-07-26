<template>
  <div id="application-checkout">
    <section id="navbar">
      <navbarApps />
    </section>
    <section id="content" class="section">
      <div class="container">
        <div class="columns">
          <breadCrumb />
        </div>
        <div class="columns">
          <div class="column is-half">
            <nav class="panel" v-for="(item, $index) in carts">
              <p class="panel-heading">
                {{ item.vendor.name }}
              </p>
              <panel-detail :cartItem="item.item" :cartIndex="$index"></panel-detail>
              <div class="shipment">
                <label for="" class="label">Informasi Pengiriman</label>
                <table class="table is-bordered">
                  <tbody>
                    <tr>
                      <td class="key-ship">Sub Total</td>
                      <td>{{ formattingPrice(item.sub_total) }}</td>
                    </tr>
                    <tr>
                      <td class="key-ship">Biaya Pengiriman</td>
                      <td>{{ formattingPrice(item.shipment.low_rates) }}</td>
                    </tr>
                    <tr>
                      <td class="key-ship">Jarak</td>
                      <td>{{ item.shipment.distance / 1000 }} Km</td>
                    </tr>
                    <tr>
                      <td class="key-ship">Durasi Pengiriman</td>
                      <td>{{ (item.shipment.duration / 60).toFixed(0) }} Menit</td>
                    </tr>
                    <tr>
                      <td class="key-ship">Total</td>
                      <td>{{ formattingPrice(item.total) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </nav>

          </div>
          <div class="column is-half">
           <totalBelanja />
          </div>
        </div>
      </div>
    </section>
    <section id="footer">
      <footerApps />
    </section>
  </div>
</template>



<style lang="scss" scoped>
  .shipment {
    margin: 1rem 0 0 0;
    .table {
      font-size: 0.85rem;
      .key-ship {
        font-weight: bolder;
      }
    }
  }
</style>

<script>
  import accounting from 'accounting-js'
  import { mapGetters, mapStates } from 'vuex'
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/MemberNavbar.vue')
  const TotalBelanja = () => import('./TotalBelanja.vue')
  const BreadCrumb = () => import('./Breadcrumb.vue')
  const PanelDetail = () => import('./PanelDetail.vue')
  export default {
    components: {
      FooterApps,
      NavbarApps,
      BreadCrumb,
      TotalBelanja,
      PanelDetail
    },
    computed: {
      ...mapGetters(['activeUser', 'carts'])
    },
    methods: {
      formattingPrice (price) {
        return accounting.formatMoney(price, {
          symbol: 'Rp ',
          thousand: '.',
          precision: 0
        })
      },
    }
  }
</script>
