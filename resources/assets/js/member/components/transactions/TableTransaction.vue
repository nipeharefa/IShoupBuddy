<template>
  <div>
    <nav class="breadcrumb breadwrapper">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li class="is-active"><a>Transaksi</a></li>
      </ul>
    </nav>
    <div class="columns">
      <div class="column">
        <div class="order-teaser" v-for="item in transactions">
          <div class="order-teaser__header">
            <span>Pesanan <a>#{{ item.id }}</a></span>
            <span>Dipesan pada {{ item.updated_at }}</span>
          </div>
          <div class="order-teaser__body columns">
            <div class="order-teaser__product column is-half" v-for="product in item.detail">
              <a class="order-product-teaser__img">
                <img :src="product.product.picture_url.small" alt="">
              </a>
              <div class="order-product-teaser__body">
                <a href="" class="order-product-teaser__title">{{ product.name }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters(['transactions', 'activeUser'])
    }
  }
</script>
