<template>
  <div>

    <nav class="breadcrumb">
      <ul>
        <li><a href="/">Halaman Depan</a></li>
        <li>
          <router-link :to="{ name: 'summaryProfile' }" append>
            {{ activeUser.name }}
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'tableTransaction' }" append>
            Transaksi
          </router-link>
        </li>
        <li class="is-active"><a>#{{ transaction.id }}</a></li>
      </ul>
    </nav>

    <section class="order_details__section">
      <div class="columns">
        <div class="column is-4">
          Order #{{ transaction.id }}
        </div>
        <div class="column is-4">
          Dipesan pada
        </div>
        <div class="column is-4">
          Total {{ transaction.nominal_string }}
        </div>
      </div>
    </section>

    <section class="order_detais__product" v-for="item in transaction.detail">
      <div class="order_details__product-body">
        <div class="order_details__product-details">
          <img :src="item.product.picture_url.small" alt="" class="order_details-product__image">
          <p class="order_details-product__name">{{ item.name }}</p>
        </div>
      </div>
    </section>

    <section class="order_details__shipping">
      <div class="columns">
        <div class="column is-half order_details__user">
          <b>Alamat Penagihan</b>
          <br>
          {{ activeUser.name }}
          <br>
          {{ activeUser.address }}
          <br>
          {{ activeUser.phone }}
        </div>
        <div class="column is-half"></div>
      </div>
    </section>
  </div>
</template>


<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    created () {
      this.getTransaction()
    },
    computed: {
      ...mapGetters([
        'activeUser',
        'transactions',
        'transaction'
      ])
    },
    data () {
      return {
        id: this.$store.state.route.params.id,
      }
    },
    methods: {
      ...mapActions([
        'initTransaction'
      ]),
      getTransaction() {
        const index = this.transactions.findIndex(x => {
          return x.id == this.id
        })

        if (true) {
          this.initTransaction(this.transactions[index])
          return;
        }
        this.$router.push({name: 'tableTransaction'})
        return

      }
    }
  }

</script>
