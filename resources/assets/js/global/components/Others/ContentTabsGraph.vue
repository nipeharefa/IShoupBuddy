<template>
  <div>
    <div class="columns">
      <div class="column is-3">
        <div class="select-control">
          <div class="select">
            <select v-model="vendorSelected" @change="getAll">
              <option value="">Semua Vendor</option>
              <option v-for="item in vendors" :value="item.vendor.id">{{ item.vendor.name }}</option>
            </select>

          </div>
        </div>

      </div>

      <div class="column is-3">
          <div class="select">
            <select name="" id="" v-model="range" @change="getAll">
              <option value="7">7 Hari Sebelumnya</option>
              <option value="30">1 Bulan Sebelumnya</option>
              <option value="90">3 Bulan Sebelumnya</option>
            </select>
          </div>
      </div>
    </div>
    <div class="columns">
      <div class="column">
        <chart-child
          :chartData="dataCollection"
          :data="dataCollection"
          :options="{responsive: true, maintainAspectRatio: false}" v-if="dataCollection">
        </chart-child>
      </div>
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  import ChartChild from './ChartChild'
  import moment from 'moment'

  export default {
    created () {
      this.getAll()
    },
    methods: {
      getStats () {
        const idSelected = this.vendorSelected
        if (idSelected === "") {
          return;
        }
        this.$http.get(`api/statistic?vendor_id=${idSelected}&product_id=${this.product.id}`).then(response => {
          this.stats = response.data.statistic
        }).catch(err => err)

        const index = this.product.vendors.findIndex( x => idSelected === x.vendor.id)
        this.vendorNameSelected = this.product.vendors[index]['vendor']['name']
      },
      getAll () {
        const vendor = this.vendorSelected
        this.$http.get(`api/statistic/all?&product_id=${this.product.id}&vendor_id=${vendor}&range=${this.range}`).then(response => {
          console.log(response.data)
          this.dataCollection = response.data
        }).catch(err => err)
      }
    },
    data () {
      return {
        vendorSelected: "",
        stats: null,
        vendorNameSelected: "",
        dataCollection: null,
        range: 7
      }
    },
    computed: {
      ...mapGetters(['product']),
      vendors () {
        if (this.product) {
          return this.product.vendors
        }
        return null
      },
      label () {
        if (this.stats) {
          return this.stats.map(x => {
            return moment(x.date).format('D/M/YYYY')
          })
        }
        return null
      },
      statsResult () {
        if (this.stats) {
          return this.stats.map(x => {
            return x.value
          })
        }
        return null
      },
      // dataCollection () {
      //   return {
      //     labels: this.label,
      //     datasets: [
      //       {
      //         label: this.vendorNameSelected,
      //         data: this.statsResult
      //       }
      //     ]
      //   }
      // }
    },
    components: {
      ChartChild
    }
  }
</script>
