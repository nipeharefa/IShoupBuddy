<template>
  <div class="modal is-active">
    <div class="modal-background" @click="hideModals"></div>
    <div class="modal-content">
      <div>
        <chart :chartData="dataCollection"
        :options="{responsive: true, maintainAspectRatio: false}" v-if="dataCollection" />
      </div>
    </div>
    <button class="modal-close is-large"></button>
  </div>
</template>

<style lang="scss" scoped>
  .modal-content {
    background-color: #fff;
  }
</style>

<script>
  import Chart from './Chart'
  export default {
    props: ['show', 'product'],
    mounted() {
      this.getStatistic()
    },
    methods: {
      hideModals () {
        this.$emit('update:show', false)
        console.log('hide')
      },
      getStatistic() {
        this.$http.get(`api/vendor/sales/${this.product.id}`).then(response => {
          console.log(response.data)
          this.dataCollection = response.data.sales
        })
      }
    },
    data () {
      return {
        stats: null,
        dataCollection: null
      }
    },
    components: {
      Chart
    }
  }
</script>
