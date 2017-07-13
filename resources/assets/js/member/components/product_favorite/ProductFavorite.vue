<template>
  <div>
    <div class="wrapping">
      <div class="wrap-breadcrumb">
        <nav class="breadcrumb">
          <ul>
            <li><a href="/">Halaman Depan</a></li>
            <router-link :to="{ name: 'summaryProfile' }" append>
              {{ activeUser.name }}
            </router-link>
            <li class="is-active"><a>Barang Favorit</a></li>
          </ul>
        </nav>
      </div>
      <div class="nusa" v-for="item in wishlists">
        <a :href="`/product/${item.product.id}`">
          <product-card :product="item.product"></product-card>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  const ProductCard = () => import('global/components/Others/ProductCard.vue')

  export default {
    components: {
      ProductCard
    },
    computed: {
      ...mapGetters([
        'wishlists',
        'activeUser'
      ])
    },
    methods: {

    }
  }
</script>
