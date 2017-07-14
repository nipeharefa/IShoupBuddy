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
        <li class="is-active"><a>Review</a></li>
      </ul>
    </nav>
    <div class="review_search__wrapper columns">
      <div class="field column is-6 has-addons">
        <p class="control">
          <input class="input" type="text" placeholder="Find a Review" v-model="keyword">
        </p>
        <p class="control">
          <a class="button is-info">
            <i class="fa fa-search"></i>
          </a>
        </p>
      </div>
    </div>
    <div class="review__wrapper columns">
      <review v-for="item in reviewFilterd" :review="item" :key="item.id" />
    </div>
  </div>
</template>


<script>
  import { mapGetters } from 'vuex'
  const Review = () => import('./Review.vue')
  export default {
    components: {
      Review
    },
    computed: {
      ...mapGetters([
        'reviews'
      ]),
      cleanKeyword () {
        return this.keyword.replace(/[|&;$%@"<>()+,]/g, "")
      },
      reviewFilterd () {
        if (this.reviews) {
          return this.reviews.filter( x => {
            return x.body.includes(this.cleanKeyword)
          })
        }
        return null
      }
    },
    data () {
      return {
        keyword: ""
      }
    }
  }
</script>
