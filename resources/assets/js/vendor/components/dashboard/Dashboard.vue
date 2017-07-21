<template>
  <div>
    <div class="columns">
      <div class="column">
        <chart :chartData="dataCollection"
        :options="{responsive: true, maintainAspectRatio: false}" v-if="dataCollection" />
      </div>

    </div>
  </div>
</template>


<script>

  import Chart from './Chart'

  import { mapGetters } from 'vuex'

  export default {
    mounted () {
      this.getStats(),
      this.getSales()
    },
    components: {
      Chart
    },
    data () {
      return {
        stats: null,
        dataCollection: null
      }
    },
    computed: {
      ...mapGetters(['activeUser'])
    },
    methods: {
      getStats () {
        this.$http.get(`api/vendor/${this.activeUser.id}/transactions`).then(response => {
          console.log(response.data)
          this.stats = response.data
        })
      },
      getSales () {
        this.$http.get(`api/vendor/sales`).then(response => {
          console.log(response.data)
          this.dataCollection = response.data.sales
        })
      }
    }
  }

</script>
