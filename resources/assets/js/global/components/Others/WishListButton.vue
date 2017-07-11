<template>
  <button class="button is-small b-add-wish" @click="addToWishList">
    <i class="fa" :class="{'fa-heart': product.liked, 'fa-heart-o': !product.liked}"></i>
    <span>Add To Wish</span>
  </button>
</template>

<style lang="scss" scoped>
  .b-add-wish {
    i {
      font-size: 1rem !important;
      margin-right: 10px;
      &.fa-heart {
        color: red;
      }
    }
  }
</style>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    props: {
      productId: {
        type: Number,
        required: true
      }
    },
    computed: {
      ...mapGetters(['product'])
    },
    methods: {
      ...mapActions(['wishProduct']),
      addToWishList () {
        const id = this.productId
        const wished = !this.product.liked

        var method = "POST"
        var urlWishAction = 'api/wishlist'

        if (this.product.liked) {
          method = "DELETE"
          urlWishAction = `api/user/unwishproduct/${id}`
        }
        this.wishProduct(wished)

        const data = {
          product_id: this.productId
        }

        const httpConf = {
          method: method,
          url: urlWishAction,
          data,
        }
        this.$http(httpConf)
        .then(response => {})
        .catch(err => {
          this.wishProduct(!wished)
        })
      }
    }
  }
</script>
