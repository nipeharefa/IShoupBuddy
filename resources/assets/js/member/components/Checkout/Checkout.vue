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
                <div class="sub_total">
                  <span>Sub Total : </span>
                  <span>{{ formattingPrice(item.sub_total) }}</span>
                </div>
                <div class="rate">
                  <span>{{ formattingPrice(item.shipment.low_rates) }}</span>
                </div>
                <div class="total">
                  <span>Total : </span>
                  <span>{{ formattingPrice(item.total) }}</span>
                </div>
                <div class="distance">
                  <span>{{ item.shipment.distance / 1000 }} Km</span>
                </div>
                <div class="duration">
                  <span>{{ item.shipment.duration }}</span>
                </div>
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
