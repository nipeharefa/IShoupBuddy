<template>
  <div>
    <div>
      <navbar-apps></navbar-apps>
    </div>

    <section class="section">
      <div class="container">
        <div class="columns">

          <div class="column">
            <breadCrumb />
          </div>

        </div>

        <div class="columns">
          <table class="table">
            <tbody>
              <tr>
                <td></td>
                <td class="image-wrapper">
                  <img :src="source.picture_url.small" :alt="source.name" class="image">
                </td>
                <td></td>
                <td class="image-wrapper">
                  <img :src="target.picture_url.small" :alt="target.name" class="image">
                </td>
              </tr>

              <tr>
                <td class="caption">Nama Produk</td>
                <td>{{ source.name}}</td>
                <td></td>
                <td>{{ target.name}}</td>
              </tr>
              <tr>
                <td class="caption">Kategori</td>
                <td>{{ source.category.name }}</td>
                <td></td>
                <td>{{ target.category.name }}</td>
              </tr>
              <tr>
                <td class="caption">Harga Terendah</td>
                <td>{{ source.minimum_price_string }}</td>
                <td></td>
                <td>{{ target.minimum_price_string }}</td>
              </tr>
              <tr>
                <td class="caption">Total Vendor</td>
                <td>{{ source.total_vendor }}</td>
                <td></td>
                <td>{{ target.total_vendor }}</td>
              </tr>

              <tr>
                <td class="caption">Rating</td>
                <td style="display: flex;">
                  <star-rating :rating="source.avg_rating"
                  :star-size="13" :read-only="true"
                  :showRating="false"
                  :activeColor="'#f7d120'" />
                  <div>
                    / {{ source.total_rating }} Ulasan
                  </div>
                </td>
                <td></td>
                <td style="display: flex;">
                  <star-rating :rating="target.avg_rating"
                  :star-size="13" :read-only="true"
                  :showRating="false"
                  :activeColor="'#f7d120'" />
                  <div>
                    / {{ target.total_rating }} Ulasan
                  </div>
                </td>
              </tr>

              <tr>
                <td class="caption">Hasil Sentimen</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td class="caption">Deskripsi</td>
                <td>{{ source.description }}</td>
                <td></td>
                <td>{{ target.description }}</td>
              </tr>
            </tbody>
          </table>
          <!-- <cardResult class="column is-half" :product="source" />
          <cardResult class="column is-half" :product="target" /> -->
        </div>

      </div>
    </section>

    <div>
      <footer-apps></footer-apps>
    </div>
  </div>
</template>


<style lang="scss" scoped>
  .table {
    .caption {
      font-weight: 500;
    }
  }
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
  const FooterApps = () => import('otherComponents/Footer.vue')
  const NavbarApps = () => import('global/components/Navbars/GuestNavbar')
  const BreadCrumb = () => import('./Breadcrumb-Compare.vue')
  const CardResult = () => import('./CardResult.vue')
  const ProductCard = () => import('global/components/Others/ProductCard.vue')
  const SlideProduct = () => import('global/components/Others/SlideProduct.vue')
  const SlideCompare = () => import('global/components/Product/SlideCompare.vue')
  import StarRating from 'vue-star-rating'

  import { mapActions, mapGetters } from 'vuex'

  export default {
    components: {
      FooterApps,
      BreadCrumb,
      NavbarApps,
      ProductCard,
      SlideProduct,
      SlideCompare,
      CardResult,
      StarRating
    },
    created () {
      this.source = window._sharedData.source
      this.target = window._sharedData.target
    },
    data () {
      return {
        activeProduct: null,
        source: null,
        target: null
      }
    },
    computed: {
      ...mapGetters(['promo'])
    }
  }
</script>
