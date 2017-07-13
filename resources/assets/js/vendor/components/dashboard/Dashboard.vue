<template>
  <div>
    <div class="columns">
      <chart :chartData="dataCollection"
    :options="{responsive: true, maintainAspectRatio: false}" />

    </div>
  </div>
</template>


<script>

  import Chart from './Chart'

  import { mapGetters } from 'vuex'

  export default {
    mounted () {
      this.getStats()
    },
    components: {
      Chart
    },
    data () {
      return {
        stats: null
      }
    },
    computed: {
      ...mapGetters(['activeUser']),
      label () {
        if (this.stats) {
          return this.stats.label
        }
        return []
      },
      statistic () {
        if (this.stats) {
          return this.stats.transactions
        }
        return []
      },
      dataCollection () {
        return {
          labels: this.label,
          datasets: [
            {
              label: 'Products',
              data: this.statistic
            }
          ]
        }
      }
    },
    methods: {
      getStats () {
        this.$http.get(`api/vendor/${this.activeUser.id}/transactions`).then(response => {
          console.log(response.data)
          this.stats = response.data
        })
      }
    }
  }

</script>
