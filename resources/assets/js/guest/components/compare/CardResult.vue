<template>
  <div class="table-wrapper-info">
    <div class="image-wrapper">
      <img :src="product.picture_url.small" alt="" class="image">
    </div>
    <table class="table">
      <tbody>
        <tr>
          <td class="caption">Nama Produk</td>
          <td>
            <a :href="`/product/${product.id}`">{{ product.name }}</a>
          </td>
        </tr>
        <tr>
          <td class="caption">Kategori</td>
          <td>{{ product.category.name }}</td>
        </tr>
        <tr>
          <td class="caption">Harga Terendah</td>
          <td>{{ product.minimum_price_string }}</td>
        </tr>
        <tr>
          <td class="caption">Total Vendor</td>
          <td>{{ product.total_vendor }}</td>
        </tr>
        <tr>
          <td class="caption">Rating</td>
          <td style="display: flex;">
            <star-rating :rating="product.avg_rating"
            :star-size="13" :read-only="true"
            :showRating="false"
            :activeColor="'#f7d120'" />
            <div>
              / {{ product.total_rating }} Ulasan
            </div>
          </td>
        </tr>
        <tr>
          <td class="caption">Tag</td>
          <td>
            <span class="tag is-primary">{{ sifat }}</span>
            <span class="tag is-primary">{{ pemakaian }}</span>
          </td>
        </tr>
        <tr>
          <td class="caption">Hasil Sentimen</td>
          <td>
            <span class="tag" :class="ratingColor">{{ ratingString }}</span>
          </td>
        </tr>
        <tr>
          <td class="caption">Deskripsi</td>
          <td>{{ product.description }}</td>
        </tr>

        <tr>
          <td>Review Terakhir</td>
          <td>
            <div v-for="item in product.recentReview" class="reviews-wrap">
              <small class="user-name">{{ item.user.name }}</small>
              <star-rating :rating="item.rating"
                  :star-size="12" :read-only="true"
                  :showRating="false"
                  :activeColor="'#f7d120'" />
              <small>
                <i>{{ item.body }}</i>
              </small>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<style style="scss" scoped>
  .image-wrapper {
    display: flex;
    justify-content: center;
  }
  .reviews-wrap {
    margin: 0.5rem 0;
    .user-name {
      font-size: 0.85rem;
    }
  }
</style>

<script>

  import sifat from 'admin/json/sifat.json'
  import pemakaian from 'admin/json/pemakaian.json'
  import StarRating from 'vue-star-rating'

  export default {
    props: {
      product: {
        required: true
      }
    },
    components: {
      StarRating
    },
    computed: {
      ratingString () {
        if (this.product) {
          switch(this.product.summary_string) {
            case 'pos':
              return "Positif"
              break
            case 'neg':
              return "Negatif"
              break
            default:
              return "Netral"
              break
          }
        }
        return "Netral"
      },
      ratingColor () {
        if (this.product) {
          switch(this.product.summary_string) {
            case 'pos':
              return "is-primary"
              break
            case 'neg':
              return "is-danger"
              break
            default:
              return "is-info"
              break
          }
        }
        return "is-info"
      },
      sifat () {
        const self = this
        const a = sifat.find( x => {
          return x.value === self.product.attributes.sifat
        })
        return a.brand
      },
      pemakaian () {
        const self = this
        const a = pemakaian.find( x => {
          return x.value === self.product.attributes.pemakaian
        })
        return a.brand
      }
    },
    methods: {
      generateLinkImage (filename) {
        if (filename) {
          return window.location.origin + '/image/medium/' + filename
        }
        return 'http://bulma.io/images/placeholders/128x128.png'
      }
    }
  }
</script>
