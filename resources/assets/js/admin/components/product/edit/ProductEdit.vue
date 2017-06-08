<template>
  <div>
    <formEditProduct v-if="product" :product="product"/>
  </div>
</template>


<script>
  const FormEditProduct = () => import('./FormEditProduct.vue')

  import  { mapGetters, mapActions } from 'vuex'
  export default {
    mounted() {
      this.getProduct()
    },
    components: {
      FormEditProduct
    },
    computed: {
      ...mapGetters([
        'product'
      ])
    },
    methods: {
      ...mapActions([
        'initProduct'
      ]),
      getProduct () {
        const id = this.$route.params.id
        this.$http.get(`/api/admin/product/${id}`).then(response => {
          this.initProduct(response.data.product)
        })
      }
    }
  }
</script>
