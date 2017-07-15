<template>
  <div>
    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'dashboard' }" append>
            Administrator
          </router-link>
        </li>
        <li>
           <router-link :to="{ name: 'listProducts' }" append>
            Produk
          </router-link>
        </li>
        <li class="is-active"><a>{{ product.name }}</a></li>
      </ul>
    </nav>
    <formEditProduct v-if="product" :product="product"/>
  </div>
</template>


<script>
  const FormEditProduct = () => import('./FormEditProduct.vue')

  import  { mapGetters, mapActions } from 'vuex'
  export default {
    created() {
      this.getProduct()
    },
    components: {
      FormEditProduct
    },
    computed: {
      ...mapGetters([
        'product',
        'products',
      ])
    },
    methods: {
      ...mapActions([
        'initProduct'
      ]),
      getProduct () {
        const id = this.$route.params.id

        const indexProduct = this.products.findIndex( x => id == x.id)

        this.initProduct(this.products[indexProduct])
      }
    }
  }
</script>
