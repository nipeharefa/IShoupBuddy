<template>
  <div class="product-review">
    <div class="product-review__head">
      <b>Product Review</b>
    </div>
    <div class="product-review__body">
      <table class="table">
        <thead>
          <td></td>
          <td>Nama Produk</td>
          <td>Total Review</td>
        </thead>
        <tbody>
          <tr v-for="(item, $index) in productSorted">
            <td>{{ $index + 1 }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.total_review }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>


<style lang="scss" scoped>
  .product-review__head {
    b {
      font-size: 0.85rem
    }
  }
</style>



<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'products'
      ]),
      productSorted () {
        const sortedProduct =  this.products.sort( (a,b) => {
          var nameA = a.total_review
          var nameB = b.total_review
          if (nameA > nameB) {
            return -1;
          }
          if (nameA < nameB) {
            return 1;
          }

          // names must be equal
          return 0;
        })

        return sortedProduct.slice(0,5);
      }
    }
  }
</script>
