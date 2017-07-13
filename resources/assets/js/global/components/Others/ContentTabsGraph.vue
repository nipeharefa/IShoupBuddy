<template>
	<div class="small chart-container">
		<chart-child
      :chartData="dataCollection"
      :options="{responsive: true, maintainAspectRatio: false}">
    </chart-child>
	</div>
</template>


<script>
import ChartChild from './ChartChild'
import { mapGetters } from 'vuex'
import moment from 'moment'
export default {
  components: {
    ChartChild
  },
  mounted () {
    this.getStats()
  },
  data () {
    return {
      stats: null
    }
  },
  methods: {
    getStats () {
      this.$http.get('api/statistic?vendor_id=44&product_id=31').then(response => {
        this.stats = response.data.statistic
      })
    }
  },
  computed: {
    ...mapGetters([
      'product'
    ]),
    label () {
      if (this.stats) {
        return this.stats.map(x => {
          return moment(x.date).format('D/M/YYYY')
        })
      }
      return []
    },
    statsResult () {
      if (this.stats) {
        return this.stats.map(x => {
          return x.value
        })
      }
      return []
    },
    statsResult () {
      if (this.stats) {
        return this.stats.map(x => {
          return x.value
        })
      }
      return []
    },
    dataCollection () {
      return {
        labels: this.label,
        datasets: [
          {
            label: this.product.vendors[0].vendor.name,
            data: this.statsResult
          }
        ]
      }
    }
  }
}
</script>
